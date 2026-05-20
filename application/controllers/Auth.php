<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index()
	{
		// Jika sudah login, redirect sesuai role
		if ($this->session->userdata('is_Loggin') == true) {

			if ($this->session->userdata('is_role') == '1') {
				redirect('superadmin');
			} elseif ($this->session->userdata('is_role') == '2') {
				redirect('user');
			}
		}

		// Jika belum login → tampilkan login
		$this->load->view('auth/v_login');
	}

	// PROSES
	public function ProsesLogin()
	{
		// Cegah login ulang jika sudah login
		if ($this->session->userdata('is_Loggin') == true) {
			redirect('auth');
		}

		$this->data['username'] = $this->input->post('username');
		$this->data['password'] = $this->input->post('password');

		$getUser = $this->M_login->getUser($this->data['username']);

		// kondisi ketika login

		if (count($getUser) == 1) {
			if (password_verify($this->data['password'], $getUser[0]->password)) {

				$dataSession = array(
					"id_user"  => $getUser[0]->id_user,
					"username"  => $getUser[0]->username,
					"is_role"   => $getUser[0]->is_role,
					"is_active"   => $getUser[0]->is_active,
					"is_Loggin" => true
					// true = 1
				);
				$this->session->set_userdata($dataSession);

				if ($getUser[0]->is_active == 1) {
					if ($getUser[0]->is_role == '1') {
						redirect('superadmin');
					} elseif ($getUser[0]->is_role == '2') {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('error', 'Akun Belum Aktif. Silahkan hubungi administrator!');
					$this->session->set_flashdata('pesan', "
                    <script>
                       Swal.fire({
                            icon: 'error',
                            title: 'Oops..!',
                            text: 'Akun Belum Aktif. Silahkan hubungi administrator!',
                            })
                    </script>
                    ");
					redirect('auth');
				}
			} else {
				$data['title'] = 'Login';
				$this->session->set_flashdata('pesan', "
                <script>
                   Swal.fire({
                        icon: 'error',
                        title: 'Oops..!',
                        text: 'Password Salah!',
                        })
                </script>
                ");
				redirect('auth');
			}
		} elseif (count($getUser) == 0) {
			$data['title'] = 'Login';
			$this->session->set_flashdata('pesan', "
            <script>
               Swal.fire({
                    icon: 'error',
                    title: 'Oops..!',
                    text: 'Akun Tidak ditemukan!',
                    })
            </script>
            ");
			redirect('auth');
		} else {
			$this->session->set_flashdata('pesan', "
            <script>
               Swal.fire({
                    icon: 'error',
                    title: 'Oops..!',
                    text: 'Username Tidak ditemukan!',
                    })
            </script>
            ");
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->unset_userdata('id_users');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('is_role');
		$this->session->unset_userdata('is_Loggin');
		redirect('auth');
	}
}
