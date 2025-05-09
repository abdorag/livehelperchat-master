<?php
#[\AllowDynamicProperties]
class erLhAbstractModelAutoResponder {
    
    use erLhcoreClassDBTrait;
    
    public static $dbTable = 'lh_abstract_auto_responder';
    
    public static $dbTableId = 'id';
    
    public static $dbSessionHandler = 'erLhcoreClassAbstract::getSession';
    
    public static $dbSortOrder = 'DESC';

    public static $dbDefaultSort = '`dep_id` ASC, `position` ASC';

	public function getState()
	{
		$stateArray = array (
			'id'         		=> $this->id,
			'name'  		    => $this->name,
			'operator'  		=> $this->operator,
			'siteaccess'  		=> $this->siteaccess,
			'wait_message'		=> $this->wait_message,
			'disabled'		    => $this->disabled,

			// Pending chat messages
			'timeout_message'	=> $this->timeout_message,
			'timeout_message_2'	=> $this->timeout_message_2,
			'timeout_message_3'	=> $this->timeout_message_3,
			'timeout_message_4'	=> $this->timeout_message_4,
			'timeout_message_5'	=> $this->timeout_message_5,

			// Pending chat messages timeouts
			'wait_timeout'		=> $this->wait_timeout,
			'wait_timeout_2'	=> $this->wait_timeout_2,
			'wait_timeout_3'	=> $this->wait_timeout_3,
			'wait_timeout_4'	=> $this->wait_timeout_4,
			'wait_timeout_5'	=> $this->wait_timeout_5,

            // Visitor not replying messaging
            'timeout_reply_message_1' => $this->timeout_reply_message_1,
            'timeout_reply_message_2' => $this->timeout_reply_message_2,
            'timeout_reply_message_3' => $this->timeout_reply_message_3,
            'timeout_reply_message_4' => $this->timeout_reply_message_4,
            'timeout_reply_message_5' => $this->timeout_reply_message_5,

            // Visitor not replying timeouts
			'wait_timeout_reply_1'	  => $this->wait_timeout_reply_1,
			'wait_timeout_reply_2'	  => $this->wait_timeout_reply_2,
			'wait_timeout_reply_3'	  => $this->wait_timeout_reply_3,
			'wait_timeout_reply_4'	  => $this->wait_timeout_reply_4,
			'wait_timeout_reply_5'	  => $this->wait_timeout_reply_5,

			// Hold messages
			'timeout_hold_message_1'	  => $this->timeout_hold_message_1,
			'timeout_hold_message_2'	  => $this->timeout_hold_message_2,
			'timeout_hold_message_3'	  => $this->timeout_hold_message_3,
			'timeout_hold_message_4'	  => $this->timeout_hold_message_4,
			'timeout_hold_message_5'	  => $this->timeout_hold_message_5,
			'wait_timeout_hold'	          => $this->wait_timeout_hold,

			// Hold timeouts
			'wait_timeout_hold_1'	  => $this->wait_timeout_hold_1,
			'wait_timeout_hold_2'	  => $this->wait_timeout_hold_2,
			'wait_timeout_hold_3'	  => $this->wait_timeout_hold_3,
			'wait_timeout_hold_4'	  => $this->wait_timeout_hold_4,
			'wait_timeout_hold_5'	  => $this->wait_timeout_hold_5,

			'only_proactive'	=> $this->only_proactive,
			'ignore_pa_chat'	=> $this->ignore_pa_chat,
			'dep_id'			=> $this->dep_id,
			'position'			=> $this->position,
			'repeat_number'		=> $this->repeat_number,
			'survey_timeout'	=> $this->survey_timeout,
			'survey_id'		    => $this->survey_id,
            'languages'         => $this->languages,
            'bot_configuration' => $this->bot_configuration,
            'user_id' => $this->user_id,
		);

		return $stateArray;
	}

	public function __toString()
	{
		return $this->name;
	}

    public function updateThis() {
        $this->saveThis();
    }
    
    public function afterSave()
    {
        $db = ezcDbInstance::get();
        $stmt = $db->prepare('DELETE FROM `lh_abstract_auto_responder_dep` WHERE `autoresponder_id` = :autoresponder_id');
        $stmt->bindValue(':autoresponder_id', $this->id,PDO::PARAM_INT);
        $stmt->execute();

        if (isset($this->department_ids) && !empty($this->department_ids)) {
            $values = [];
            foreach ($this->department_ids as $department_id) {
                $values[] = "(" . $this->id . "," . $department_id . ")";
            }
            if (!empty($values)) {
                $db->query('INSERT INTO `lh_abstract_auto_responder_dep` (`autoresponder_id`,`dep_id`) VALUES ' . implode(',',$values));
            }
        }
    }

    public function afterRemove()
    {
        $db = ezcDbInstance::get();
        $stmt = $db->prepare('DELETE FROM `lh_abstract_auto_responder_dep` WHERE `autoresponder_id` = :autoresponder_id');
        $stmt->bindValue(':autoresponder_id', $this->id,PDO::PARAM_INT);
        $stmt->execute();

        $db = ezcDbInstance::get();
        $stmt = $db->prepare('DELETE FROM `lh_abstract_auto_responder_chat` WHERE `auto_responder_id` = :auto_responder_id');
        $stmt->bindValue(':auto_responder_id', $this->id,PDO::PARAM_INT);
        $stmt->execute();
    }

	public function customForm() {
	    return 'autoresponder.tpl.php';
	}
	
   	public function getFields()
   	{
   	    return include ('lib/core/lhabstract/fields/erlhabstractmodelautoresponder.php');
	}

	public function getModuleTranslations()
	{
	    $metaData = array('permission_delete' => array('module' => 'lhchat','function' => 'administrateresponder'),'permission' => array('module' => 'lhchat','function' => 'administrateresponder'),'name' => erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/proactivechatinvitation','Auto responder'));
	    /**
	     * Get's executed before permissions check. It can redirect to frontpage throw permission exception etc
	     * */
	    erLhcoreClassChatEventDispatcher::getInstance()->dispatch('feature.can_use_autoresponder', array('object_meta_data' => & $metaData));
	    
		return $metaData;
	}
	
	public function __get($var)
	{
	   switch ($var) {
	   	case 'left_menu':
	   	       $this->left_menu = '';
	   		   return $this->left_menu;
	   		break;

	   case 'user':
	   	       $this->user = null;
	   	       if ($this->user_id > 0) {
                   $this->user = erLhcoreClassModelUser::fetch($this->user_id);
               }
	   		   return $this->user;
	   		break;
	   		
	   	case 'dep':
	   	       if ($this->dep_id > 0) {
	   	           $this->dep = erLhcoreClassModelDepartament::fetch($this->dep_id);
	   	       } else {
	   	           $this->dep = false;
	   	       }
	   		   return $this->dep;

           case 'timeout_hold_message_1_translated':
           case 'timeout_hold_message_2_translated':
           case 'timeout_hold_message_3_translated':
           case 'timeout_hold_message_4_translated':
           case 'timeout_hold_message_5_translated':
           case 'wait_timeout_hold_translated':
               $attr = str_replace('_translated','',$var);
               $this->{$var} = null;
               if ($this->{$attr} != '') {
                   $msgData = explode('|||', $this->{$attr});

                   if (count($msgData) > 1) {
                       $item = trim($msgData[mt_rand(0,count($msgData)-1)]);
                   } else {
                       $item = $this->{$attr};
                   }

                   $this->{$var} = $item;
               }
               return $this->{$var};

           case 'close_message':
           case 'offline_message':
           case 'wait_op_timeout_reply_1':
           case 'wait_op_timeout_reply_2':
           case 'wait_op_timeout_reply_3':
           case 'wait_op_timeout_reply_4':
           case 'wait_op_timeout_reply_5':
           case 'timeout_op_reply_message_1':
           case 'timeout_op_reply_message_2':
           case 'timeout_op_reply_message_3':
           case 'timeout_op_reply_message_4':
           case 'timeout_op_reply_message_5':
           case 'languages_ignore':
           case 'multilanguage_message':
               $this->{$var} = null;
               if (isset($this->bot_configuration_array[$var])) {

                   if (is_array($this->bot_configuration_array[$var])) {
                       $item = $this->bot_configuration_array[$var];
                   } else {
                       $msgData = explode('|||', $this->bot_configuration_array[$var]);

                       if (count($msgData) > 1) {
                           $item = trim($msgData[mt_rand(0,count($msgData)-1)]);
                       } else {
                           $item = $this->bot_configuration_array[$var];
                       }
                   }

                   $this->{$var} = $item;
               }
               return $this->{$var};

        case 'bot_configuration_array':
           $attr = str_replace('_array','',$var);
           if (!empty($this->{$attr})) {
               $jsonData = json_decode($this->{$attr},true);
               if ($jsonData !== null) {
                   $this->{$var} = $jsonData;
               } else {
                   $this->{$var} = array();
               }
           } else {
               $this->{$var} = array();
           }
           return $this->{$var};

	   	case 'dep_frontend':
	   	       $this->dep_frontend = $this->dep === false ? '-' : (string)$this->dep;
	   		   return $this->dep_frontend;

	   	case 'wait_timeout_reply_total':
	   	       $this->wait_timeout_reply_total = 0;

               for ($i = 5; $i >= 1; $i--) {
                    if ($this->{'wait_timeout_reply_' . $i} > 0) {
                        $this->wait_timeout_reply_total = $i;
                        break;
                    }
               }

	   		   return $this->wait_timeout_reply_total;

           case 'department_ids_front':
               $this->department_ids_front = [];
               if ($this->id > 0) {
                   $db = ezcDbInstance::get();
                   $stmt = $db->prepare("SELECT `dep_id` FROM `lh_abstract_auto_responder_dep` WHERE `autoresponder_id` = " . $this->id);
                   $stmt->execute();
                   $this->department_ids_front = $stmt->fetchAll(PDO::FETCH_COLUMN);
               }

               if ($this->dep_id > 0) {
                   $this->department_ids_front[] = $this->dep_id;
               }

               return $this->department_ids_front;

           case 'list_department':
               $this->list_department = '';
               if ($this->dep !== false) {
                   $this->list_department = (string)$this->dep;
               }
               $this->department_ids_front;
               if (!empty($this->department_ids_front)) { $deps = implode(', ',erLhcoreClassModelDepartament::getList(['filterin' => ['id' => $this->department_ids_front]]));
                   $this->list_department = htmlspecialchars_decode(erLhcoreClassDesign::shrt($deps, 50, '...', 30, ENT_QUOTES)); // Abstract class does it's own encode
               }
               return $this->list_department;

	   	default:
	   		break;
	   }
	}

    public function beforeSave()
    {
        $this->bot_configuration = json_encode($this->bot_configuration_array);
    }

    public function beforeUpdate()
    {
        $this->bot_configuration = json_encode($this->bot_configuration_array);
    }

	public static function processAutoResponder(erLhcoreClassModelChat $chat) {

		$session = erLhcoreClassAbstract::getSession();
		$q = $session->createFindQuery( 'erLhAbstractModelAutoResponder' );
		$q->where( '(' . $q->expr->eq( 'siteaccess', $q->bindValue( erLhcoreClassSystem::instance()->SiteAccess ) )
            .' OR `siteaccess` = \'\') AND ('.$q->expr->eq( 'dep_id', $q->bindValue( $chat->dep_id ) ).' OR `dep_id` = 0 OR `id` IN (SELECT `autoresponder_id` FROM `lh_abstract_auto_responder_dep` WHERE `dep_id` = ' . (int)$chat->dep_id . ') ) AND `disabled` = 0 AND `only_proactive` = 0 AND `user_id` = 0')
		->orderBy('`dep_id` ASC, `position` ASC')
		->limit( 1 );

		$messagesToUser = $session->find( $q );

		if ( !empty($messagesToUser) ) {

            foreach ($messagesToUser as $message) {
                if ($message->isValidConditions($chat) === true) {
                    $message->translateByChat($chat->chat_locale);
                    return $message;
                }
             }
		}
		return false;
	}

    public function isValidConditions($chat)
    {
        $validFirst = true;
        $checkFirst = false;

        $validSecond = true;
        $checkSecond = false;

        if (isset($this->bot_configuration_array['mpc_nm']) && $this->bot_configuration_array['mpc_nm'] > 0) {
            $checkFirst = true;
            if (($chat->number_in_queue - 1) < $this->bot_configuration_array['mpc_nm']) {
                $validFirst = false;
            }
        }

        if (isset($this->bot_configuration_array['pnd_repetitiveness'])) {

            if ($this->bot_configuration_array['pnd_repetitiveness'] == \erLhcoreClassModelCannedMsg::REP_DAILY) {

                $dayShort = array(
                    1 => 'mod',
                    2 => 'tud',
                    3 => 'wed',
                    4 => 'thd',
                    5 => 'frd',
                    6 => 'sad',
                    7 => 'sud'
                );

                $dateTime = new DateTime('now', (isset($this->bot_configuration_array['pnd_time_zone']) && $this->bot_configuration_array['pnd_time_zone'] != '' ? new DateTimeZone($this->bot_configuration_array['pnd_time_zone']) : null));

                if (isset($this->bot_configuration_array['pnd_' . $dayShort[$dateTime->format('N')].'_start_time']) &&
                    isset($this->bot_configuration_array['pnd_' . $dayShort[$dateTime->format('N')] . '_end_time'])) {

                    $checkSecond = true;

                    $dateTimeStart = (int)str_replace(':','', $this->bot_configuration_array['pnd_' . $dayShort[$dateTime->format('N')].'_start_time']);
                    $dateTimeEnd = (int)str_replace(':','', $this->bot_configuration_array['pnd_' . $dayShort[$dateTime->format('N')].'_end_time']);

                    $validSecond = $dateTimeStart <= (int)$dateTime->format('Hi') && $dateTimeEnd >= (int)$dateTime->format('Hi');
                }

            } elseif ($this->bot_configuration_array['pnd_repetitiveness'] == \erLhcoreClassModelCannedMsg::REP_PERIOD) {

                if (isset($this->bot_configuration_array['pnd_active_from_edit']) &&
                    isset($this->bot_configuration_array['pnd_active_to_edit'])) {

                    $checkSecond = true;

                    $dateTimeStart = new DateTime($this->bot_configuration_array['pnd_active_from_edit'], (isset($this->bot_configuration_array['pnd_time_zone']) && $this->bot_configuration_array['pnd_time_zone'] != '' ? new DateTimeZone($this->bot_configuration_array['pnd_time_zone']) : null));

                    $dateTimeEnd = new DateTime($this->bot_configuration_array['pnd_active_to_edit'], (isset($this->bot_configuration_array['pnd_time_zone']) && $this->bot_configuration_array['pnd_time_zone'] != '' ? new DateTimeZone($this->bot_configuration_array['pnd_time_zone']) : null));

                    $validSecond = $dateTimeStart->getTimestamp() <= time() && $dateTimeEnd->getTimestamp() >= time();
                }

            } elseif ($this->bot_configuration_array['pnd_repetitiveness'] == \erLhcoreClassModelCannedMsg::REP_PERIOD_REP) {

                $checkSecond = true;
                
                $dateTime = new DateTime('now', (isset($this->bot_configuration_array['pnd_time_zone']) && $this->bot_configuration_array['pnd_time_zone'] != '' ? new DateTimeZone($this->bot_configuration_array['pnd_time_zone']) : null));

                $dateTimeStart = new DateTime($this->bot_configuration_array['pnd_active_from_edit'], (isset($this->bot_configuration_array['pnd_time_zone']) && $this->bot_configuration_array['pnd_time_zone'] != '' ? new DateTimeZone($this->bot_configuration_array['pnd_time_zone']) : null));
                $fromCompare = $dateTimeStart->format('mdHi');

                $dateTimeTo = new DateTime($this->bot_configuration_array['pnd_active_to_edit'], (isset($this->bot_configuration_array['pnd_time_zone']) && $this->bot_configuration_array['pnd_time_zone'] != '' ? new DateTimeZone($this->bot_configuration_array['pnd_time_zone']) : null));
                $toCompare = $dateTimeTo->format('mdHi');

                $currentCompare = $dateTime->format('mdHi');

                $validSecond = (int)$fromCompare <= (int)$currentCompare && (int)$toCompare >= (int)$currentCompare;
            }
        }

        return ($checkSecond === true && $validSecond === true) || ($checkFirst === true && $validFirst === true) || ($checkSecond === false && $checkFirst === false);
    }

	public static function updateAutoResponder(erLhcoreClassModelChat & $chat)
    {
        $responder = erLhAbstractModelAutoResponder::processAutoResponder($chat);

        if ($responder instanceof erLhAbstractModelAutoResponder) {
            if (($responderChat = $chat->auto_responder) !== false) {
                $responderChat->auto_responder_id = $responder->id;
                $responderChat->wait_timeout_send = 1 - $responder->repeat_number;
                $responderChat->active_send_statu = 0;
                $responderChat->pending_send_status = 0;
                $responderChat->wait_timeout_send = 0;
                $responderChat->saveThis();

                $responderChat->auto_responder = $responder;
            } else {
                $responderChat = new erLhAbstractModelAutoResponderChat();
                $responderChat->auto_responder_id = $responder->id;
                $responderChat->chat_id = $chat->id;
                $responderChat->wait_timeout_send = 1 - $responder->repeat_number;

                $responderChat->saveThis();

                $chat->auto_responder_id = $responderChat->id;
            }
        } elseif (($responderChat = $chat->auto_responder) !== false) {
            $responderChat->removeThis();
            $chat->auto_responder_id = 0;
        }
    }

    public function hasMeta(& $chat, $type, $counter = null, $options = array()) {
        $botCounter = $counter !== null ? '_' . $counter : '';

        if (isset($this->bot_configuration_array[$type . '_bot_id' . $botCounter]) && $this->bot_configuration_array[$type . '_bot_id' . $botCounter] > 0 &&
            isset($this->bot_configuration_array[$type . $botCounter . '_trigger_id']) && $this->bot_configuration_array[$type . $botCounter . '_trigger_id'] > 0) {
            return true;
        }

        return false;
    }

	public function getMeta(& $chat, $type, $counter = null, $options = array())
    {

        $botCounter = $counter !== null ? '_' . $counter : '';

        if (isset($this->bot_configuration_array[$type . '_bot_id' . $botCounter]) && $this->bot_configuration_array[$type . '_bot_id' . $botCounter] > 0 &&
            isset($this->bot_configuration_array[$type . $botCounter . '_trigger_id']) && $this->bot_configuration_array[$type . $botCounter . '_trigger_id'] > 0) {

            $trigger = erLhcoreClassModelGenericBotTrigger::fetch($this->bot_configuration_array[$type . $botCounter . '_trigger_id']);

            if ($trigger instanceof erLhcoreClassModelGenericBotTrigger) {

                if ($chat->gbot_id == 0) {
                    $chat->gbot_id = $trigger->bot_id;
                    $chat->updateThis(array('update' => array('gbot_id')));
                }

                if (isset($options['store_messages']) && $options['store_messages'] == true) {
                    $args = ['args' => ['ignore_times' => true]];

                    if (isset($options['override_nick']) && !empty($options['override_nick'])) {
                        $args['args']['override_nick'] = $options['override_nick'];
                    }

                    if (isset($options['override_user_id']) && $options['override_user_id'] > 0) {
                        $args['args']['override_user_id'] = $options['override_user_id'];
                    }

                    $args['args']['auto_responder'] = true;

                    $last_msg_id = $chat->last_msg_id;

                    $message = erLhcoreClassGenericBotWorkflow::processTrigger($chat, $trigger, true, $args);

                    // Dispatch event for a new messages
                    foreach (erLhcoreClassModelmsg::getList(['filtergt' => ['id' => $last_msg_id], 'filter' => ['chat_id' => $chat->id]]) as $newMessage) {
                        erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.before_auto_responder_msg_saved', array('no_auto_events' => true, 'ignore_times' => true, 'msg' => & $newMessage, 'chat' => & $chat));
                    }

                } else {
                    $message = erLhcoreClassGenericBotWorkflow::processTrigger($chat, $trigger, false, array('args' => array('do_not_save' => true)));
                }

                if ($message instanceof erLhcoreClassModelmsg) {
                    if (isset($options['include_message']) && $options['include_message'] == true) {
                        return array(
                            'msg' => $message->msg,
                            'meta_msg' => $message->meta_msg,
                        );
                    } else {
                        return $message->meta_msg;
                    }
                }
            }
        }

        if (isset($options['include_message']) && $options['include_message'] == true) {
            return array(
                'msg' => '',
                'meta_msg' => '',
            );
        }

        return '';
    }

	public function dependFooterJs()
    {

        return '<script type="text/javascript" src="'.erLhcoreClassDesign::designJS('js/lhc.cannedmsg.js').'"></script>' . '<script type="module" src="'.erLhcoreClassDesign::designJSStatic('js/svelte/public/build/languages.js').'"></script>';
    }

    public function setTranslationData($data)
    {
        if (isset($data['timeout_message']) && $data['timeout_message'] != '') {
            $this->timeout_message = $data['timeout_message'];
        }

        if (isset($data['wait_timeout_hold']) && $data['wait_timeout_hold'] != '') {
            $this->wait_timeout_hold = $data['wait_timeout_hold'];
        }

        if (isset($data['wait_message']) && $data['wait_message'] != '') {
            $this->wait_message = $data['wait_message'];
        }

        if (isset($data['operator']) && $data['operator'] != '') {
            $this->operator = $data['operator'];
        }
        
        if (isset($data['close_message']) && $data['close_message'] != '') {
            $this->close_message = $data['close_message'];
        }

        if (isset($data['multilanguage_message']) && $data['multilanguage_message'] != '') {
            $this->multilanguage_message = $data['multilanguage_message'];
        }

        for ($i = 1; $i <= 5; $i++) {

            if (isset($data['timeout_op_trans_reply_message_' . $i]) && $data['timeout_op_trans_reply_message_' . $i] != '') {
                $this->{'timeout_op_reply_message_' . $i} = $data['timeout_op_trans_reply_message_' . $i];
            }

            if (isset($data['timeout_message_' . $i]) && $data['timeout_message_' . $i] != '') {
                $this->{'timeout_message_' . $i} = $data['timeout_message_' . $i];
            }

            if (isset($data['timeout_reply_message_' . $i]) && $data['timeout_reply_message_' . $i] != '') {
                $this->{'timeout_reply_message_' . $i} = $data['timeout_reply_message_' . $i];
            }

            if (isset($data['timeout_hold_message_' . $i]) && $data['timeout_hold_message_' . $i] != '') {
                $this->{'timeout_hold_message_' . $i} = $data['timeout_hold_message_' . $i];
            }
        }
    }

    /**
     * @desc translate auto responder if translation by chat exists
     *
     * @param $locale
     */
    public function translateByChat($locale, $params = array()) {

        if ($locale != '' && $this->languages != '') {
            $languages = json_decode($this->languages, true);

            if (is_array($languages)) {

                $translated = false;

                // Try to find exact match
                foreach ($languages as $data) {
                    if (in_array($locale, $data['languages']) && (!isset($data['dep_ids']) || empty($data['dep_ids']) || (isset($params['dep_id']) && $params['dep_id'] > 0 && in_array($params['dep_id'], $data['dep_ids']))) ) {
                        $this->setTranslationData($data);
                        $translated = true;
                        break;
                    }
                }

                if ($translated == false) {
                    // Try to match general match by first two letters
                    $localeShort = explode('-',$locale)[0];
                    foreach ($languages as $data) {
                        if (in_array($localeShort, $data['languages']) && (!isset($data['dep_ids']) || empty($data['dep_ids']) || (isset($params['dep_id']) && $params['dep_id'] > 0 && in_array($params['dep_id'], $data['dep_ids'])))) {
                            $this->setTranslationData($data);
                            break;
                        }
                    }
                }
            }
        }

        // Try to find personal translations
        if (isset($params['user_id']) && $params['user_id'] > 0 && isset($params['dep_id']) && $params['dep_id'] > 0) {

            $session = erLhcoreClassAbstract::getSession();
            $q = $session->createFindQuery( 'erLhAbstractModelAutoResponder' );
            $q->where( '('.$q->expr->eq( 'dep_id', $q->bindValue( $params['dep_id'] ) ).' OR dep_id = 0) AND user_id = ' . (int)$params['user_id'])
            ->orderBy('dep_id DESC, position ASC')
            ->limit( 1 );

            $messagesToUser = $session->find( $q );

            if ( !empty($messagesToUser) ) {
                $message = array_shift($messagesToUser);
                $message->translateByChat($locale);

                if ($message->timeout_message != '') {
                    $this->timeout_message = $message->timeout_message;
                }

                if ($message->wait_timeout_hold != '') {
                    $this->wait_timeout_hold = $message->wait_timeout_hold;
                }

                if ($message->wait_message != '') {
                    $this->wait_message = $message->wait_message;
                }

                if ($message->operator != '') {
                    $this->operator = $message->operator;
                }

                if ($message->close_message != '') {
                    $this->close_message = $message->close_message;
                }

                if ($message->multilanguage_message != '') {
                    $this->multilanguage_message = $message->multilanguage_message;
                }

                for ($i = 1; $i <= 5; $i++) {

                    if ($message->{'timeout_op_reply_message_' . $i} != '') {
                        $this->{'timeout_op_reply_message_' . $i} = $message->{'timeout_op_reply_message_' . $i};
                    }

                    if ($message->{'timeout_message_' . $i} != '') {
                        $this->{'timeout_message_' . $i} = $message->{'timeout_message_' . $i};
                    }

                    if ($message->{'timeout_reply_message_' . $i} != '') {
                        $this->{'timeout_reply_message_' . $i} = $message->{'timeout_reply_message_' . $i};
                    }

                    if ($message->{'timeout_hold_message_' . $i} != '') {
                        $this->{'timeout_hold_message_' . $i} = $message->{'timeout_hold_message_' . $i};
                    }
                }
            }
        }

    }

    public function validateInput()
    {
        $definition = array(
            'languages' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_message' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_message_2' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_message_3' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_message_4' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_message_5' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),

            'timeout_reply_message_1' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_reply_message_2' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_reply_message_3' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_reply_message_4' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_reply_message_5' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),

            'timeout_op_trans_reply_message_1' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_op_trans_reply_message_2' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_op_trans_reply_message_3' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_op_trans_reply_message_4' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_op_trans_reply_message_5' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),

            'wait_timeout_hold' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_hold_message_1' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_hold_message_2' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_hold_message_3' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_hold_message_4' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'timeout_hold_message_5' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'wait_message' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'operator' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'close_message' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'multilanguage_message' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'languages_ignore' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw',null,FILTER_REQUIRE_ARRAY),
            'DepartmentID' => new ezcInputFormDefinitionElement(
                ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 1),FILTER_REQUIRE_ARRAY
            ),
            'dep_ids' => new ezcInputFormDefinitionElement(
                ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 1),FILTER_REQUIRE_ARRAY
            ),
        );

        $form = new ezcInputForm( INPUT_POST, $definition );

        if ( $form->hasValidData( 'languages_ignore' ) && !empty($form->languages_ignore) )
        {
            $botConfiguration = $this->bot_configuration_array;
            $botConfiguration['languages_ignore'] = $form->languages_ignore;
            $this->bot_configuration_array = $botConfiguration;
        } else {
            $botConfiguration = $this->bot_configuration_array;
            if (isset($botConfiguration['languages_ignore'])) {
                unset($botConfiguration['languages_ignore']);
                $this->bot_configuration_array = $botConfiguration;
            }
        }

        $languagesData = array();
        if ( $form->hasValidData( 'languages' ) && !empty($form->languages) )
        {
            foreach ($form->languages as $index => $languages) {
                $languagesData[] = array(
                    'languages' => $form->languages[$index],
                    'dep_ids' => ($form->hasValidData('dep_ids') && isset($form->dep_ids[$index]) ? $form->dep_ids[$index] : null),
                    'timeout_message' => ($form->hasValidData('timeout_message') ? $form->timeout_message[$index] : null),
                    'timeout_message_2' => ($form->hasValidData('timeout_message_2') ? $form->timeout_message_2[$index] : null),
                    'timeout_message_3' => ($form->hasValidData('timeout_message_3') ? $form->timeout_message_3[$index] : null),
                    'timeout_message_4' => ($form->hasValidData('timeout_message_4') ? $form->timeout_message_4[$index] : null),
                    'timeout_message_5' => ($form->hasValidData('timeout_message_5') ? $form->timeout_message_5[$index] : null),
                    'timeout_reply_message_1' => $form->timeout_reply_message_1[$index],
                    'timeout_reply_message_2' => $form->timeout_reply_message_2[$index],
                    'timeout_reply_message_3' => $form->timeout_reply_message_3[$index],
                    'timeout_reply_message_4' => $form->timeout_reply_message_4[$index],
                    'timeout_reply_message_5' => $form->timeout_reply_message_5[$index],

                    'timeout_op_trans_reply_message_1' => $form->timeout_op_trans_reply_message_1[$index],
                    'timeout_op_trans_reply_message_2' => $form->timeout_op_trans_reply_message_2[$index],
                    'timeout_op_trans_reply_message_3' => $form->timeout_op_trans_reply_message_3[$index],
                    'timeout_op_trans_reply_message_4' => $form->timeout_op_trans_reply_message_4[$index],
                    'timeout_op_trans_reply_message_5' => $form->timeout_op_trans_reply_message_5[$index],

                    'wait_timeout_hold' => $form->wait_timeout_hold[$index],
                    'timeout_hold_message_1' => $form->timeout_hold_message_1[$index],
                    'timeout_hold_message_2' => $form->timeout_hold_message_2[$index],
                    'timeout_hold_message_3' => $form->timeout_hold_message_3[$index],
                    'timeout_hold_message_4' => $form->timeout_hold_message_4[$index],
                    'timeout_hold_message_5' => $form->timeout_hold_message_5[$index],
                    'wait_message' => ($form->hasValidData('wait_message') ? $form->wait_message[$index] : null),
                    'operator' => ($form->hasValidData('operator') ?  $form->operator[$index] : null),
                    'close_message' => ($form->hasValidData('close_message') ?  $form->close_message[$index] : null),
                    'multilanguage_message' => ($form->hasValidData('multilanguage_message') ?  $form->multilanguage_message[$index] : null),
                );
            }
        }

        $this->languages = json_encode($languagesData);

        $userDepartments = true;
        if (!erLhcoreClassUser::instance()->hasAccessTo('lhautoresponder','exploreautoresponder_all')) {
            $userDepartments = erLhcoreClassUserDep::parseUserDepartmetnsForFilter(erLhcoreClassUser::instance()->getUserID(), erLhcoreClassUser::instance()->cache_version);
        }

        if ( !$form->hasValidData( 'DepartmentID' )  ) {

            $response = erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.validate_canned_msg_user_departments',array('canned_msg' => & $cannedMessage, 'errors' => & $Errors));

            $this->department_ids = $this->department_ids_front = [];

            // Perhaps extension did some internal validation and we don't need anymore validate internaly
            if ($response === false) {
                $this->dep_id = 0;
            }

            if ($userDepartments !== true) {
                if ($this->dep_id == 0 && !erLhcoreClassUser::instance()->hasAccessTo('lhautoresponder','see_global')) {
                    $params['errors'][] =  erTranslationClassLhTranslation::getInstance()->getTranslation('chat/cannedmsg','Please choose a department!');
                }
            }

        } else {
            $this->department_ids_front = $this->department_ids = $form->DepartmentID;
            // -1 means, individual per department
            $this->dep_id = -1;

            if ($userDepartments !== true) {
                if (
                    ($this->dep_id == 0 && !erLhcoreClassUser::instance()->hasAccessTo('lhautoresponder','see_global'))
                ) {
                    $params['errors'][] = erTranslationClassLhTranslation::getInstance()->getTranslation('chat/cannedmsg','Please choose a department!');
                }

                if (!empty(array_diff($this->department_ids, $userDepartments))) {
                    $params['errors'][] = erTranslationClassLhTranslation::getInstance()->getTranslation('chat/cannedmsg','You cannot modify canned messages for the departments you are not assigned to!');
                }
            }
        }
    }

    public function checkPermission(){
        if (!erLhcoreClassUser::instance()->hasAccessTo('lhautoresponder','exploreautoresponder_all')) {
            $userDepartments = erLhcoreClassUserDep::parseUserDepartmetnsForFilter( erLhcoreClassUser::instance()->getUserID(),  erLhcoreClassUser::instance()->cache_version);
            if ($userDepartments !== true) {
                if ((!erLhcoreClassUser::instance()->hasAccessTo('lhautoresponder','see_global') && $this->dep_id == 0) ||
                    (!empty(array_diff($Msg->department_ids_front, $userDepartments)) && $this->dep_id == -1)
                ) {
                    return false;
                }
            }
        }
    }

    public function getFilter(){

        $filter = array();

        // Global filters
        $departmentFilter = erLhcoreClassUserDep::conditionalDepartmentFilter();

        $conditions = array();

        if (!empty($departmentFilter)){
            $conditions[] = '(dep_id IN (' . implode(',',$departmentFilter['filterin']['id']) . '))';
        }

        $userFilterDefault = erLhcoreClassGroupUser::getConditionalUserFilter();
        if (!empty($userFilterDefault)){
            $conditions[] = '(user_id IN (' . implode(',',$userFilterDefault['filterin']['id']) . '))';
        }

        if (!empty($conditions)) {
            $filter['filter_custom'][] = '('.implode(' OR ',$conditions).')';
        }

        return $filter;

    }

   	public $id = null;
	public $siteaccess = '';
	public $position = 0;
	public $wait_message = '';
	
	// 1 Message
	public $wait_timeout = 0;
	public $timeout_message = '';
	
	// 2 Message
	public $wait_timeout_2 = 0;
	public $timeout_message_2 = '';
	
	// 3 Message
	public $wait_timeout_3 = 0;
	public $timeout_message_3 = '';
	
	// 4 Message
	public $wait_timeout_4 = 0;
	public $timeout_message_4 = '';
	
	// 5 Message
	public $wait_timeout_5 = 0;
	public $timeout_message_5 = '';

	// On-hold attributes
	public $timeout_hold_message_1 = '';
	public $timeout_hold_message_2 = '';
	public $timeout_hold_message_3 = '';
	public $timeout_hold_message_4 = '';
	public $timeout_hold_message_5 = '';

	public $wait_timeout_hold_1 = 0;
	public $wait_timeout_hold_2 = 0;
	public $wait_timeout_hold_3 = 0;
	public $wait_timeout_hold_4 = 0;
	public $wait_timeout_hold_5 = 0;

	// 1 Message
	public $wait_timeout_reply_1 = 0;
	public $timeout_reply_message_1 = '';

	// 2 Message
	public $wait_timeout_reply_2 = 0;
	public $timeout_reply_message_2 = '';

	// 3 Message
	public $wait_timeout_reply_3 = 0;
	public $timeout_reply_message_3 = '';

	// 4 Message
	public $wait_timeout_reply_4 = 0;
	public $timeout_reply_message_4 = '';

	// 5 Message
	public $wait_timeout_reply_5 = 0;
	public $timeout_reply_message_5 = '';

	// Default hold message
	public $wait_timeout_hold = '';

	public $languages = '';

	public $bot_configuration = '';

	// Auto responder name
	public $name = '';

	public $operator = '';

	// After hour many seconds in active chat redirect user to survey
	public $survey_timeout = 0;

	// This auto responder applies only to proactive chats
	public $only_proactive = 0;

	// @todo implement
	public $survey_id = 0;

	public $dep_id = 0;
    public $department_ids = [];
	public $repeat_number = 1;
	
	public $ignore_pa_chat = 0;
	
	public $user_id = 0;
	public $disabled = 0;

	public $hide_add = false;
	public $hide_delete = false;

    public $disable_angular = true;

    public $has_filter = true;
    public $filter_name = 'autoresponder';

}

?>