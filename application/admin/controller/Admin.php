<?php
namespace app\admin\controller;

use app\base\controller\Base;
use think\Loader;

class Admin extends Base
{

    /**
     * 获取管理员列表
     * @return [type] [description]
     */
    public function lst()
    {
        //管理员列表
        $res = model('admin')->getAdmin();
        return $this->fetch('', ['res' => $res]);
    }


    /**
     * 添加管理员
     */
    public function add()
    {
        if (request()->isPost()) {
            //数据库字段 网页字段转换，过滤参数
            $param = [
                'group_id' => 'group_id',
                'username' => 'username',
                'password' => 'password',
                'phone' => 'phone',
            ];
            $param_data = $this->buildParam($param);

            //实例化验证器
            $validate = Loader::validate('Admin');
            //验证
            if (!$validate->scene('add')->check($param_data)) {
                return $this->error($validate->getError());
            }

            //加入数据库
            $res = model('admin')->addAdmin($param_data);
            if ($res) {
                $this->success('添加管理员成功', 'lst');
            } else {
                $this->error('添加管理员失败');
            }
            return;
        }
        $auth_groups = model('AuthGroup')->select();
        return $this->fetch('', ['auth_groups' => $auth_groups]);
    }

    /**
     * 编辑
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        if (request()->isPost()) {
            //数据库字段 网页字段转换，过滤参数
            $param = [
                'group_id' => 'group_id',
                'id' => 'id',
                'username' => 'username',
                'password' => 'password',
                'phone' => 'phone',
            ];
            $param_data = $this->buildParam($param);

            //实例化验证器
            $validate = Loader::validate('Admin');
            //验证
            if (!$validate->scene('change')->check($param_data)) {
                return $this->error($validate->getError());
            }

            //修改数据
            $res = model('admin')->savePW($param_data);
            if ($res) {
                $this->success('修改成功', 'index/index');
            } else {
                $this->error('修改失败');
            }
        }
        $auth_groups = model('AuthGroup')->select();
        $admin = model('admin')->getAdminOne($id);
        return $this->fetch('', ['auth_groups' => $auth_groups, 'admin' => $admin]);
    }


    /**
     * 修改账号
     * @return [type] [description]
     */
    public function editPW()
    {
        if (request()->isPost()) {
            //数据库字段 网页字段转换，过滤参数
            $param = [
                'id' => 'id',
                'username' => 'username',
                'password' => 'password',
                'phone' => 'phone',
            ];
            $param_data = $this->buildParam($param);

            //实例化验证器
            $validate = Loader::validate('Admin');
            //验证
            if (!$validate->scene('change')->check($param_data)) {
                return $this->error($validate->getError());
            }

            //修改数据
            $res = model('admin')->savePW($param_data);
            if ($res) {
                $this->success('修改成功', 'index/index');
            } else {
                $this->error('修改失败');
            }
        }
        return $this->fetch();
    }


    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function del($id)
    {

        if (model('admin')->delAdmin($id)) {
            $this->success('删除成功', 'lst');
        } else {
            $this->error('修改失败');
        }
    }


    /**
     * 退出
     * @return [type] [description]
     */
    public function loginout()
    {
        session(null);
        $this->success('退出成功', 'Login/login');
    }


    /**
     * 修改密码
     * @return [type] [description]
     */
    public function changePW()
    {
        $id = session(session_id() . '_uid', '');
        $userinfo = model('admin')->find($id);
        return $this->fetch('', ['userinfo' => $userinfo]);
    }

    /**
     * 验证手机号
     * @return [type] [description]
     */
    public function checkPhone()
    {
        $phone = input('phone');
        $username = input('username');
        $res = model('admin')->where(['phone' => $phone, 'username' => $username])->find();
        if ($res) {
            echo $this->show(1043);
        } else {
            echo $this->show(1042);
        }
    }


    /**
     * 注册ajax验证
     * @return [type] [description]
     */
    public function yanzheng()
    {
        if (request()->isAjax()) {
            $username = input('username') ? input('username') : '';//验证用户名
            $phone = input('phone') ? input('phone') : '';//验证手机号
            if (isset($username) && !empty($username)) {
                if (model('admin')->where(['username' => $username])->find()) {
                    echo $this->show(1031);
                } else {
                    echo $this->show(1032);
                }
            } elseif (isset($phone) && !empty($phone)) {
                if (model('admin')->where(['phone' => $phone])->find()) {
                    echo $this->show(1033);
                } else {
                    echo $this->show(1034);
                }
            }
        }
    }


}