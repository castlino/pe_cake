<?php
class AppError extends ErrorHandler {

    function error404($params) {
                $this->controller->layout = 'default_no_countdown';
           	parent::error404($params);
    }
}
?>
