<?

namespace Shared\Models;

class UserPassword extends Model {

    protected $userId;

    protected $cipherText;



    public function getUserId() {
        return $this->userId();
    }

    public function getCipherText() {
        return $this->cipherText;
    }

    public function setUserId($input) {
        $this->userId = $input;
    }

    public function setCipherText($input) {
        $this->cipherText = $input;
    }
}
