<?php

namespace LiveControls\Alerts\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SweetAlert extends Component
{

    public $hasAlert;

    public $title;
    public $type;
    public $message;

    public $html;

    public $confirmButtonText;
    public $denyButtonText;
    public $cancelButtonText;

    public $confirmEvent;
    public $denyEvent;
    public $cancelEvent;

    public $inputFields;
    public $inputFieldNames;

    public $timer;
    public $timerProgressBar;

    public $imageUrl;
    public $imageHeight;
    public $imageWidth;
    public $imageAlt;

    protected $listeners = ['alertSent' => 'createAlert'];

    public function mount(){
        $this->hasAlert = false;
        if(Session::has('alert')){
            $alertInfo = Session::get('alert');
            $this->createAlert($alertInfo, false);
        }
    }

    public function render()
    {
        return view('livecontrols-alerts::livewire.sweetalert.sweet-alert');
    }

    public function createAlert(array $alertInfo, bool $fromListener = true){
        $this->hasAlert = true;
        $this->type = $alertInfo["type"];
        $this->title = \Helvetiapps\LiveControls\Utils\Arrays::array_get("title", $alertInfo, __('livecontrols::alerts.'.$this->type));
        $this->message = \Helvetiapps\LiveControls\Utils\Arrays::array_get('message', $alertInfo);
        $this->html = \Helvetiapps\LiveControls\Utils\Arrays::array_get('html', $alertInfo);
        $this->confirmButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('confirmButtonText', $alertInfo);
        $this->denyButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('denyButtonText', $alertInfo);
        $this->cancelButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('cancelButtonText', $alertInfo);
        $this->confirmEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('confirmEvent', $alertInfo);
        $this->denyEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('denyEvent', $alertInfo);
        $this->cancelEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('cancelEvent', $alertInfo);
        $this->timer = \Helvetiapps\LiveControls\Utils\Arrays::array_get('timer', $alertInfo, null);
        $this->timerProgressBar = \Helvetiapps\LiveControls\Utils\Arrays::array_get('timerProgressBar', $alertInfo, false);
        $this->inputFields = \Helvetiapps\LiveControls\Utils\Arrays::array_get('inputFields', $alertInfo, false);
        
        $this->imageUrl = \Helvetiapps\LiveControls\Utils\Arrays::array_get('imageUrl', $alertInfo, null);
        $this->imageWidth = \Helvetiapps\LiveControls\Utils\Arrays::array_get('imageWidth', $alertInfo, null);
        $this->imageHeight = \Helvetiapps\LiveControls\Utils\Arrays::array_get('imageHeight', $alertInfo, null);
        $this->imageAlt = \Helvetiapps\LiveControls\Utils\Arrays::array_get('imageAlt', $alertInfo, null);

        //If Inputfields are not empty, add them to the bottom of $this->html
        $this->inputFieldNames = "";
        if($this->inputFields !== false){
            if($this->html == null){
                $this->html = "";
            }
            $this->inputFieldNames = "[";
            foreach($this->inputFields as $idx => $inputField){
                if($idx < count($this->inputFields)){
                    $this->inputFieldNames .= 'document.getElementById("'.$inputField["name"].'").value,';
                }else{
                    $this->inputFieldNames .= 'document.getElementById("'.$inputField["name"].'").value';
                }
                $this->html .= $inputField["html"];
            }
            $this->inputFieldNames .= "]";
        }

        if(!$fromListener){
            return;
        }

        $alertArr = [
            'type' => $this->type,
            'title' => $this->title,
            'timer' => $this->timer,
            'timerProgressBar' => $this->timerProgressBar,
            'message' => $this->message,
            'html' => $this->html,
            'confirmButtonText' => $this->confirmButtonText,
            'denyButtonText' => $this->denyButtonText,
            'cancelButtonText' => $this->cancelButtonText,
            'confirmEvent' => $this->confirmEvent,
            'denyEvent' => $this->denyEvent,
            'cancelEvent' => $this->cancelEvent,
            'imageUrl' => $this->imageUrl,
            'imageWidth' => $this->imageWidth,
            'imageHeight' => $this->imageHeight,
            'imageAlt' => $this->imageAlt,
            'inputFields' => $this->inputFields
        ];

        $this->emit('showAlert', $alertArr);
    }
}
