<?php
class WebUser extends CWebUser
{
    public function __get($name)
    {
        if ($this->hasState('userInfo')) {
            $user=$this->getState('userInfo',array());
            if (isset($user[$name])) {
                return $user[$name];
            }
        }

        return parent::__get($name);
    }

    public function login($identity, $duration=0) {
        $this->setState('userInfo', $identity->getUser());
        parent::login($identity, $duration);
    }
}

?>
