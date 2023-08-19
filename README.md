# Alerts
 ![Release Version](https://img.shields.io/github/v/release/live-controls/alerts)
 ![Packagist Version](https://img.shields.io/packagist/v/live-controls/alerts?color=%23007500)
 Alerts library for live-controls

## Requirements
- Laravel 9+
- Livewire 2+


## Translations
- English (en)
- German (de)
- Brazilian Portuguese (pt_BR)


## Installation

1. Install Alerts package
```ps
composer require live-controls/alerts
```
2. Include @livewire('livecontrols-alerts') to layout before </body> tag


## Usage
First Step:
Add HasPopups trait to Livewire Controls or classes that make use of redirect().
```php
use HasPopups;
```

### New System
The new system has many benefits over the old one, you can not only set custom titles and buttons, but you can also call Livewire events if the user did press confirm, deny or cancel buttons. More options will mostlikely be added in the future.

Required Parameters: 'type' and 'message', the rest is optional

From Controller
```php
$popupType = 'success'; //Can be success, warning, error, info and question
$popupTitle = 'Some Title'; //Will be shown as title
$popupMessage = 'This is some message'; //can contain HTML so be aware of that!
$popupConfirmButtonText = 'Confirm'; //The text shown on the confirm button, if you dont want to show the button set it to null or don't set it in the call
$popupDenyButtonText = 'Deny'; //Same as confirm button
$popupCancelButtonText = 'Cancel'; //Same as confirm button
$popupConfirmEvent = 'confirmed'; //The name of the event that will be called when the user clicks on the confirm button set to null or don't set it in the call to ignore it
$popupDenyEvent = 'denied'; //Same as confirm event
$popupCancelEvent = 'canceled'; //Same as confirm event

//New in 0.4-dev
$popupTimer = 2000; //Will close the window after 2000ms
$popupTimerProgressBar = true; //If set to true it will show a progressbar on the bottom
$popupImageUrl = 'https://yourpage.com/somepicture.jpg'; //Sets a picture for the popup
$popupImageHeight = 100; //Sets the height of the image
$popupImageWidth = 100; //Sets the width of the image
$popupImageAlt = 'Some Text'; //Sets an alternative text to the image
$popupHtml = '<strong>I'm strong!</strong>'; //Sets the html of the message, ignores message if set! Take care with that and don't allow userinput on this one!

return redirect()->route('dashboard')->with('popup', [
'type' => $popupType,
'title' => $popupTitle,
'message' => $popupMessage,
'confirmButtonText' => $popupConfirmButtonText,
'denyButtonText' => $popupDenyButtonText,
'cancelButtonText' => $popupCancelButtonText,
'confirmEvent' => $popupConfirmEvent,
'denyEvent' => $popupDenyEvent,
'cancelEvent' => $popupCancelEvent,

'timer' => $popupTimer,
'timerProgressBar' => $popupTimerProgressBar,
'imageUrl' => $popupImageUrl,
'imageHeight' => $popupImageHeight,
'imageWidth' => $popupImageWidth,
'imageAlt' => $popupImageAlt,
'html' => $popupHtml
]');

//New in 0.5-dev
return redirect()->route('dashboard')->popup(['type' => 'success', 'message' => 'Hello World!']);
```

From Livewire
```php
$this->dispatchBrowserEvent('popup', [
 'type' => 'error',
 'title' => 'Test Title',
 'message' => 'It\'s working!',
 'confirmButtonText' => 'Confirm',
 'denyButtonText' => 'Deny',
 'cancelButtonText' => 'Cancel',
 'confirmEvent' => 'confirmPopup',
 'denyEvent' => 'denyPopup',
 'cancelEvent' => 'cancelPopup',

//new in 0.4-dev
'timer' => 2000,
'timerProgressBar' => true,
'imageUrl' => 'https://yourpage.com/cat.jpg',
'imageHeight' => 200,
'imageWidth' => 200,
'imageAlt' => 'A cute cat!',
'html' => '<strong>Im strong!</strong>'
]);

//New in 0.5-dev
$this->popup([
'type' => 'info',
'message' => 'Hello World!'
]);
```

### Old System
If you want to use the old system you can send a session variable like so:

From Controller
```php
return redirect()->route('dashboard')->with('success', 'This had success!'); //Will show a success popup
return redirect()->route('dashboard')->with('exception'), 'This had an exception!'); //Will show an error popup
return redirect()->route('dashboard')->with('info', 'This is an information'); //Will show an info popup
return redirect()->route('dashboard')->with('warning', 'This is a warning'); //Will show a warning popup
```

From Livewire
```php
$this->dispatchBrowserEvent('showToast', ['success', 'This had success!']); //Will show a success popup
$this->dispatchBrowserEvent('showToast', ['exception', 'This had an exception']); //Will show an error popup
$this->dispatchBrowserEvent('showToast', ['info', 'This is an information']); //Will show an info popup
$this->dispatchBrowserEvent('showToast', ['warning', 'This is a warning']); //Will show a warning popup
```
As you can see the old system is very limited, you can only add the message to it and thats it. If you work on a new project, use the new system instead!
