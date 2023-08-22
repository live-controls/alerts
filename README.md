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
2. Include @livewire('livecontrols-sweetalert') to layout before </body> tag


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
$alertType = 'success'; //Can be success, warning, error, info and question
$alertTitle = 'Some Title'; //Will be shown as title
$alertMessage = 'This is some message'; //can contain HTML so be aware of that!
$alertConfirmButtonText = 'Confirm'; //The text shown on the confirm button, if you dont want to show the button set it to null or don't set it in the call
$alertDenyButtonText = 'Deny'; //Same as confirm button
$alertCancelButtonText = 'Cancel'; //Same as confirm button
$alertConfirmEvent = 'confirmed'; //The name of the event that will be called when the user clicks on the confirm button set to null or don't set it in the call to ignore it
$alertDenyEvent = 'denied'; //Same as confirm event
$alertCancelEvent = 'canceled'; //Same as confirm event

//New in 0.4-dev
$alertTimer = 2000; //Will close the window after 2000ms
$alertTimerProgressBar = true; //If set to true it will show a progressbar on the bottom
$alertImageUrl = 'https://yourpage.com/somepicture.jpg'; //Sets a picture for the alert
$alertImageHeight = 100; //Sets the height of the image
$alertImageWidth = 100; //Sets the width of the image
$alertImageAlt = 'Some Text'; //Sets an alternative text to the image
$alertHtml = '<strong>I'm strong!</strong>'; //Sets the html of the message, ignores message if set! Take care with that and don't allow userinput on this one!

return redirect()->route('dashboard')->with('alert', [
'type' => $alertType,
'title' => $alertTitle,
'message' => $alertMessage,
'confirmButtonText' => $alertConfirmButtonText,
'denyButtonText' => $alertDenyButtonText,
'cancelButtonText' => $alertCancelButtonText,
'confirmEvent' => $alertConfirmEvent,
'denyEvent' => $alertDenyEvent,
'cancelEvent' => $alertCancelEvent,

'timer' => $alertTimer,
'timerProgressBar' => $alertTimerProgressBar,
'imageUrl' => $alertImageUrl,
'imageHeight' => $alertImageHeight,
'imageWidth' => $alertImageWidth,
'imageAlt' => $alertImageAlt,
'html' => $alertHtml
]');

//New in 0.5-dev
return redirect()->route('dashboard')->alert(['type' => 'success', 'message' => 'Hello World!']);
```

From Livewire
```php
$this->dispatchBrowserEvent('alert', [
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
$this->alert([
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
$this->dispatchBrowserEvent('showAlert', ['success', 'This had success!']); //Will show a success popup
$this->dispatchBrowserEvent('showAlert', ['exception', 'This had an exception']); //Will show an error popup
$this->dispatchBrowserEvent('showAlert', ['info', 'This is an information']); //Will show an info popup
$this->dispatchBrowserEvent('showAlert', ['warning', 'This is a warning']); //Will show a warning popup
```
As you can see the old system is very limited, you can only add the message to it and thats it. If you work on a new project, use the new system instead!

### Manual Installation
If you prefer to install the SweetAlert2 scripts yourself, follow the instructions here: 
Installation: https://sweetalert2.github.io/#download
Installation of Themes: https://github.com/sweetalert2/sweetalert2-themes