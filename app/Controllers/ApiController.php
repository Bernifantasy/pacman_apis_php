<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\config\APIJwt;
use App\Models\PartidesModel;
use App\Models\TokensModel;
use Firebase\JWT\JWT;

class ApiController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }

    public function createUser()
    {
        helper("form");

        $rules = [
            'nom_usuari' => 'required',
            'password' => 'required|min_length[4]',
            'password_confirm' => 'required',
            'email' => 'required|valid_email',
            'edat' => 'required|integer',
            'telefon' => 'required|integer',
            'pais' => 'required',

        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new UsersModel();
        $user = $model->getUserByMailOrUsername($this->request->getVar('nom_usuari'));

        if ($user) {
            return $this->respond([
                'status' => 'error',
                'message' => 'L\'usuari ja existeix'
            ], 400);
        }
        if ($this->request->getVar('password') !== $this->request->getVar('password_confirm')) {
            return $this->fail('Password confirmation does not match');
        }


        $data = [
            'name' => $this->request->getVar('nom_usuari'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'edad' => $this->request->getVar('edat'),
            'telefono' => $this->request->getVar('telefon'),
            'pais' => $this->request->getVar('pais'),
        ];

        if ($model->insert($data)) {
            return $this->respond([
                'status' => 200,
                'messages' => 'User created successfully'
            ]);
        } else {
            return $this->fail('Failed to create user');
        }
    }

    public function login()
    {
        helper("form");

        $rules = [
            'nom_usuari' => 'required',
            'password' => 'required|min_length[4]'
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new UsersModel();
        $user = $model->getUserByMailOrUsername($this->request->getVar('nom_usuari'));

        if (!$user) return $this->failNotFound('User Not Found');

        $verify = password_verify($this->request->getVar('password'), $user['password']);

        if (!$verify) return $this->fail('Wrong Password');

        /****************** GENERATE TOKEN ********************/
        helper("jwt");
        $APIGroupConfig = "default";
        $cfgAPI = new \Config\APIJwt($APIGroupConfig);

        $data = array(
            "uid" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email']
        );

        $token = newTokenJWT($cfgAPI->config(), $data);
        /****************** END TOKEN GENERATION **************/

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'User logged In successfully',
            'token' => $token
        ];
        return $this->respondCreated($response);
    }

    public function logged()
    {
        return $this->respond([
            'status' => 'ok',
            'logged' => true
        ]);
    }

    public function updateUser()
    {
        helper("form, jwt");
        $APIGroupConfig = "default";
        $cfgAPI = new \Config\APIJwt($APIGroupConfig);

        $token = getToken($cfgAPI->config(), $this->request);

        if (!isset($token['data']->uid)) {
            return $this->failUnauthorized('Token no vàlid');
        }

        $model = new UsersModel();
        $user = $model->getUserById($token['data']->uid);

        $rules = [
            'nom_usuari' => 'required',
            'password' => 'required|min_length[4]',
            'email' => 'required|valid_email',
            'edat' => 'required|integer',
            'telefon' => 'required|integer',
            'pais' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->request->getVar('password') !== $this->request->getVar('password_confirm')) {
            return $this->fail('Password confirmation does not match');
        }

        $updateData = [
            'name' => $this->request->getVar('nom_usuari'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'edad' => $this->request->getVar('edat'),
            'telefono' => $this->request->getVar('telefon'),
            'pais' => $this->request->getVar('pais')
        ];

        if ($model->update($user, $updateData)) {
            return $this->respond([
                'status' => 200,
                'messages' => 'Usuari actualitzat correctament'
            ]);
        } else {
            return $this->fail('No s\'ha pogut actualitzar l\'usuari');
        }
    }


    public function logout()
    {
        helper("jwt");
        $APIGroupConfig = "default";
        $cfgAPI = new \Config\APIJwt($APIGroupConfig);
        $token = getToken($cfgAPI->config(), $this->request);
        $model = new UsersModel();
        $user = $model->getUserById($token['data']->uid);

        if (!$user) return $this->failNotFound('User Not Found');

        $modelTokens = new TokensModel();
        $modelTokens->revoke($token['data']);

        return $this->respond([
            'status' => 200,
            'messages' => 'User logged out successfully'
        ]);
    }

    public function add_game()
    {
        helper("jwt");
        $APIGroupConfig = "default";
        $cfgAPI = new \Config\APIJwt($APIGroupConfig);

        $token = getToken($cfgAPI->config(), $this->request);
        if (!isset($token['data']->uid)) {
            return $this->failUnauthorized('Token no vàlid');
        }


        if (!$this->request->getVar('data') || !$this->request->getVar('resultat') || !$this->request->getVar('puntuacio') || !$this->request->getVar('durada') || !$this->request->getVar('dificultat')) {
            return $this->failValidationErrors('Paràmetres incomplets');
        }

        $partidaData = [
            'usuari_id'    => $token['data']->uid,
            'data_partida' => $this->request->getVar('data'),
            'resultat'     => $this->request->getVar('resultat'),
            'puntuacio'    => $this->request->getVar('puntuacio'),
            'durada'       => $this->request->getVar('durada'),
            'dificultat'   => $this->request->getVar('dificultat')
        ];

        $model = new PartidesModel();
        if ($model->insert($partidaData)) {
            return $this->respond([
                'status' => 'ok',
                'message' => 'Partida registrada'
            ],);
        } else {
            return $this->failServerError('Error al registrar la partida');
        }
    }

    public function get_user_last_games()
    {
        helper("jwt");
        $APIGroupConfig = "default";
        $cfgAPI = new \Config\APIJwt($APIGroupConfig);

        $token = getToken($cfgAPI->config(), $this->request);

        if (!isset($token['data']->uid)) {
            return $this->failUnauthorized('Token no vàlid');
        }

        $model = new PartidesModel();

        $partides = $model->get_user_last_games($token['data']->uid);

        $result = [];
        foreach ($partides as $partida) {
            $result[] = [
                'data'     => $partida['data_partida'],
                'guanyat'  => $partida['resultat'] == 1,
                'punts'    => $partida['puntuacio'],
                'durada'   => $partida['durada'],
            ];
        }

        return $this->respond([
            'status' => 'ok',
            'partides' => $result,
        ]);
    }

    public function get_user_stats()
    {
        helper("jwt");
        $APIGroupConfig = "default";
        $cfgAPI = new \Config\APIJwt($APIGroupConfig);

        $token = getToken($cfgAPI->config(), $this->request);
        if (!isset($token['data']->uid)) {
            return $this->failUnauthorized('Token no vàlid');
        }

        $usuariId = $token['data']->uid;
        $model = new PartidesModel();

        $partides = $model->where('usuari_id', $usuariId)->findAll();

        $total = count($partides);
        $guanyades = 0;
        $puntuacioTotal = 0;
        $duradaTotal = 0;

        foreach ($partides as $partida) {
            if ($partida['resultat'] == 1) {
                $guanyades++;
            }
            $puntuacioTotal += $partida['puntuacio'] ?? 0;
            $duradaTotal += $partida['durada'] ?? 0;
        }

        $perdudes = $total - $guanyades;
        $percentatge = $total > 0 ? ($guanyades / $total) * 100 : 0;
        $mitjanaPunts = $total > 0 ? ($puntuacioTotal / $total) : 0;
        $mitjanaDurada = $total > 0 ? ($duradaTotal / $total) : 0;

        return $this->respond([
            'status' => 'ok',
            'total' => $total,
            'guanyades' => $guanyades,
            'perdudes' => $perdudes,
            'percentatge_victories' => $percentatge,
            'mitjana_punts' => $mitjanaPunts,
            'mitjana_durada' => $mitjanaDurada
        ]);
    }
}
