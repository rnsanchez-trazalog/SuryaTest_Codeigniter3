<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('pagination');
		$this->load->helper('form'); // Load the Form Helper
    }
	
	public function index()
	{
		$this->load->helper('url');

		$users = $this->User_model->get_all_users();
		
		$config = array();
        $config['base_url'] = site_url('Welcome/index');
        $config['total_rows'] = $this->User_model->get_count();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users'] = $this->User_model->get_users($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('testEnvironment', $data);
		// $this->load->view('welcome_message');
	}

	public function registrarUsuario() {
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $telefono = $this->input->post('telefono');
        $imagenPerfil = '';


        if (!empty($_FILES['imagenPerfil']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagenPerfil')) {
                $imagenPerfil = $_FILES['imagenPerfil']['name'];
                $uploadData = $this->upload->data();
            } else {
                // Handle upload error
                $error = $this->upload->display_errors();
                echo json_encode(array('status' => 'error', 'message' => $error));
                return;
            }		
        }
		if($nombre == '' || $email == '') {
			echo json_encode(array('status' => 'error', 'message' => 'Por favor, rellene todos los campos requeridos.'));
			return;
		}
        $data = array(
            'Nombre' => $nombre,
            'Email' => $email,
            'Telefono' => !empty($telefono) ? $telefono : NULL,
        	'ImagenPerfil' => !empty($imagenPerfil) ? $imagenPerfil : NULL
        );

        $result['insert'] = $this->User_model->insert_user($data);

		if($result['insert'] == true) {
			$result['status'] = 'success';
		} else {
			$result['status'] = 'error';
		}
		echo json_encode($result);
    }
	public function getUser($id) {
        $user = $this->User_model->get_user_by_id($id);
        echo json_encode($user);
    }

    public function editarUsuario() {
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $telefono = $this->input->post('telefono');
        $imagenPerfil = $this->input->post('imagenPerfil_hidden');

        if (!empty($_FILES['imagenPerfil']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 2048; // 2MB
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagenPerfil')) {
                $uploadData = $this->upload->data();
                $imagenPerfil = $uploadData['file_name'];
            } else {
                $error = $this->upload->display_errors();
                echo json_encode(array('status' => 'error', 'message' => $error));
                return;
            }
        }
		if($nombre == '' || $email == '') {
			echo json_encode(array('status' => 'error', 'message' => 'Por favor, rellene todos los campos requeridos.'));
			return;
		}
        $data = array(
            'Nombre' => $nombre,
            'Email' => $email,
            'Telefono' => !empty($telefono) ? $telefono : NULL,
        	'ImagenPerfil' => !empty($imagenPerfil) ? $imagenPerfil : NULL
        );

        $result['update'] = $this->User_model->update_user($id, $data);

        if ($result['update']) {
            $result['status'] = 'success';
        } else {
            $result['status'] = 'error';
        }
        echo json_encode($result);
    }

    public function eliminarUsuario($id) {
        $user = $this->User_model->get_user_by_id($id);
    
        if ($user) {
            $imagePath = './uploads/' . $user->ImagenPerfil;
            if (file_exists($imagePath) && !empty($user->ImagenPerfil)) {
                unlink($imagePath);
            }
    
            $result['delete'] = $this->User_model->delete_user($id);
    
            if ($result['delete']) {
                $result['status'] = 'success';
            } else {
                $result['status'] = 'error';
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = 'User not found';
        }
    
        echo json_encode($result);
    }
}
