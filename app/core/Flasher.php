<?php
class Flasher
{
    public static function  setMessage($message, $action, $type)
    {
        $_SESSION['msg'] = [
            'message' => $message,
            'action' => $action,
            'type' => $type
        ];
    }

    public static function Message()
    {
        if (isset($_SESSION['msg'])) {
            echo '<div class="alert alert-' . $_SESSION['msg']['type'] . ' alert-dismissible fade show" role="alert">
            <strong>' . $_SESSION['msg']['message'] . '</strong> 
            ' . $_SESSION['msg']['action'] . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            unset($_SESSION['msg']);
        }
    }
}
