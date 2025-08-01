<?php
#[\AllowDynamicProperties]
class erLhcoreClassModelMailconvFile
{
    use erLhcoreClassDBTrait;

    public static $dbTable = 'lhc_mailconv_file';

    public static $dbTableId = 'id';

    public static $dbSessionHandler = 'erLhcoreClassMailconv::getSession';

    public static $dbSortOrder = 'DESC';

    public function getState()
    {
        return array(
            'id' => $this->id,
            'message_id' => $this->message_id,
            'size' => $this->size,
            'name' => $this->name,
            'description' => $this->description,
            'extension' => $this->extension,
            'type' => $this->type,
            'attachment_id' => $this->attachment_id,
            'file_path' => $this->file_path,
            'file_name' => $this->file_name,
            'content_id' => $this->content_id,
            'disposition' => $this->disposition,
            'conversation_id' => $this->conversation_id,
            'width' => $this->width,
            'height' => $this->height,
            'meta_msg' => $this->meta_msg,
        );
    }

    public function __toString()
    {
        return $this->name;
    }

    public function beforeRemove()
    {
        if (file_exists($this->file_path_server)){
            unlink($this->file_path_server);
        }

        if ($this->file_path != '') {
            erLhcoreClassFileUpload::removeRecursiveIfEmpty('var/', str_replace('var/', '', $this->file_path));
        }
    }

    public function __get($var)
    {
        switch ($var) {
            case 'ctime_front':
                return date('Ymd') == date('Ymd', $this->ctime) ? date(erLhcoreClassModule::$dateHourFormat, $this->ctime) : date(erLhcoreClassModule::$dateDateHourFormat, $this->ctime);

            case 'file_path_server':
                $this->file_path_server = $this->file_path . $this->file_name;
                return $this->file_path_server;

            case 'meta_msg_array':
                $this->meta_msg_array = array();
                if ($this->meta_msg != '') {
                    $jsonData = json_decode($this->meta_msg, true);
                    if ($jsonData !== null) {
                        $this->meta_msg_array = $jsonData;
                    }
                }
                return $this->meta_msg_array;

            case 'file_body':
                return 'data:'.$this->type.';base64,'.base64_encode(file_get_contents($this->file_path_server));

            case 'file_body_embed':
                return '[mailfilebody='.$this->id . '_' . $this->security_hash . ']';

            default:
                ;
                break;
        }
    }

    public $id = NULL;
    public $message_id = null;
    public $size = 0;
    public $name = '';
    public $file_name = '';
    public $description = '';
    public $extension = '';
    public $type = '0';
    public $attachment_id = '0';
    public $file_path = '';
    public $content_id = '';
    public $disposition = '';
    public $conversation_id = 0;
    public $width = 0;
    public $height = 0;
    public $meta_msg = '';
    public $is_archive = false;
}

?>