<?php

namespace App\Jobs\Backend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TableModels;

class UpdateJob
{
    use Dispatchable, Queueable;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $phone
     */
    private $phone;

    /**
     * @var string $role_id
     */
    private $role_id;

    /**
     * @var string $password
     */
    private $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->id = $params['id'];
        $this->name = $params['name'];
        $this->email = $params['email'];
        $this->role_id = $params['role_id'];
        $this->phone = $params['phone'];
        $this->password = $params['password'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = TableModels\User::findOrFail($this->id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->password = bcrypt($this->password);
        $flag = $user->save();

        $user->roles()->detach();

        $role = TableModels\Role::find($this->role_id);

        $user->roles()->attach($role);

        if ($flag) {
            $code = trans('pheicloud.response.success.code');
            $msg = trans('pheicloud.response.success.msg');
        } else {
            $code = trans('pheicloud.response.error.code');
            $msg = trans('pheicloud.response.error.msg');
        }

        $response = [
            'code' => $code,
            'msg' => $msg,
        ];

        return response()->json($response);
    }
}
