<?php

namespace LiveControls\Alerts\Traits\SweetAlert;

trait HasAlerts{

    public function alert(array $data){
        $this->dispatchBrowserEvent('alert',$data); 
    }

    public function alertInfo(string $message, string $title = null, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('alert', [
            'type' => 'info',
            'title' => is_null($title) ? __('livecontrols-alerts::alerts.info') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function alertWarn(string $message, string $title = null, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('alert', [
            'type' => 'warning',
            'title' => is_null($title) ? __('livecontrols-alerts::alerts.warning') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function alertSuccess(string $message, string $title = null, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'title' => is_null($title) ? __('livecontrols-alerts::alerts.success') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function alertError(string $message, string $title = null, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('alert', [
            'type' => 'error',
            'title' => is_null($title) ? __('livecontrols-alerts::alerts.error') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function alertQuestion(string $message, string $title = null, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('alert', [
            'type' => 'question',
            'title' => is_null($title) ? __('livecontrols-alerts::alerts.question') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function alertRedirect(string $route, array $data, array $routeParameters = []){
        return redirect()->route($route, $routeParameters)->with('alert', $data);
    }
}