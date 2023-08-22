<div>
    <!-- SWEET ALERT 2 -->
    @if(config('livecontrols_alerts.local_files', false) === false)
        @if($darkMode === true)
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
        @endif

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif

    <script type="text/javascript">
    //NEW SYSTEM
    window.addEventListener('alert', event => {
        Livewire.emit('alertSent', event.detail);
    });

    Livewire.on('showAlert', alertArr => {
        if(alertArr["inputFields"] !== false){
            //WITH INPUT
            Swal.fire({
                title: alertArr["title"],
                text: alertArr["message"],
                html: alertArr["html"],
                icon: alertArr["type"],
                timer: alertArr["timer"],
                timerProgressBar: alertArr["timerProgressBar"],
                showConfirmButton: alertArr["confirmButtonText"] == null ? false : true,
                showDenyButton: alertArr["denyButtonText"] == null ? false : true,
                showCancelButton: alertArr["cancelButtonText"] == null ? false : true,
                confirmButtonText: alertArr["confirmButtonText"] == null ? '' : alertArr["confirmButtonText"],
                denyButtonText: alertArr["denyButtonText"] == null ? '' : alertArr["denyButtonText"],
                cancelButtonText: alertArr["cancelButtonText"] == null ? '' : alertArr["cancelButtonText"],
                imageUrl: alertArr["imageUrl"],
                imageHeight: alertArr["imageHeight"],
                imageWidth: alertArr["imageWidth"],
                imageAlt: alertArr["imageAlt"],
                focusConfirm: false
            }).then((result) => { 
                if(result.isConfirmed){
                    let results = new Map();
                    alertArr["inputFields"].forEach(function callback(value, index){
                        results.set(value["name"], document.getElementById(value["name"]).value);
                    });
                    Livewire.emit(alertArr["confirmEvent"], Object.fromEntries(results));
                }else if (result.isDenied){
                    Livewire.emit(alertArr["denyEvent"]);
                }else if(result.isDismissed){
                    if(result.dismiss == Swal.DismissReason.cancel){
                        Livewire.emit(alertArr["cancelEvent"]);
                    }
                }
            });
        }else{
            //WITHOUT INPUT
            Swal.fire({
                title: alertArr["title"],
                text: alertArr["message"],
                html: alertArr["html"],
                icon: alertArr["type"],
                timer: alertArr["timer"],
                timerProgressBar: alertArr["timerProgressBar"],
                showConfirmButton: alertArr["confirmButtonText"] == null ? false : true,
                showDenyButton: alertArr["denyButtonText"] == null ? false : true,
                showCancelButton: alertArr["cancelButtonText"] == null ? false : true,
                confirmButtonText: alertArr["confirmButtonText"] == null ? '' : alertArr["confirmButtonText"],
                denyButtonText: alertArr["denyButtonText"] == null ? '' : alertArr["denyButtonText"],
                cancelButtonText: alertArr["cancelButtonText"] == null ? '' : alertArr["cancelButtonText"],
                imageUrl: alertArr["imageUrl"],
                imageHeight: alertArr["imageHeight"],
                imageWidth: alertArr["imageWidth"],
                imageAlt: alertArr["imageAlt"]
            }).then((result) => { 
                if(result.isConfirmed){
                    Livewire.emit(alertArr["confirmEvent"]);
                }else if (result.isDenied){
                    Livewire.emit(alertArr["denyEvent"]);
                }else if(result.isDismissed){
                    if(result.dismiss == Swal.DismissReason.cancel){
                        Livewire.emit(alertArr["cancelEvent"]);
                    }
                }
            });
        }
    });

    @if($hasAlert)
        @if($inputFields !== false)
            alert('Inputfields not supported in this version due to exceptions');
            Swal.fire({
                title: "{{ $title }}",
                text: "{{ $message }}",
                html: @js($html),
                icon: "{{ $type }}",
                showConfirmButton: {{ $confirmButtonText == null ? 'false' : 'true' }},
                showDenyButton: {{ $denyButtonText == null ? 'false' : 'true' }},
                showCancelButton: {{ $cancelButtonText == null ? 'false' : 'true' }},
                confirmButtonText: "{{ $confirmButtonText }}",
                denyButtonText: "{{ $denyButtonText }}",
                cancelButtonText: "{{ $cancelButtonText }}",
                imageUrl: "{{ $imageUrl }}",
                imageHeight: {{ $imageHeight == null ? 'null' : $imageHeight }},
                imageWidth: {{ $imageWidth == null ? 'null' : $imageWidth }},
                imageAlt: "{{ $imageAlt }}",
                focusConfirm: false
            });
            //TODO: Add inputfields functionality with POST Route for confirmEvent and GET route for rest
        @else
            Swal.fire({
                title: "{{ $title }}",
                text: "{{ $message }}",
                html: "{{ $html }}",
                icon: "{{ $type }}",
                timer: {{ $timer == null ? config('livecontrols_alerts.default_timer', 2500) : $timer }},
                timerProgressBar: {{ $timerProgressBar == null ? 'false' : 'true' }},
                showConfirmButton: {{ $confirmButtonText == null ? 'false' : 'true' }},
                showDenyButton: {{ $denyButtonText == null ? 'false' : 'true' }},
                showCancelButton: {{ $cancelButtonText == null ? 'false' : 'true' }},
                confirmButtonText: "{{ $confirmButtonText }}",
                denyButtonText: "{{ $denyButtonText }}",
                cancelButtonText: "{{ $cancelButtonText }}",
                imageUrl: "{{ $imageUrl }}",
                imageHeight: {{ $imageHeight == null ? 'null' : $imageHeight }},
                imageWidth: {{ $imageWidth == null ? 'null' : $imageWidth }},
                imageAlt: "{{ $imageAlt }}"
            }).then((result) => { 
                if(result.isConfirmed){
                    Livewire.emit('{{ $confirmEvent }}');
                }else if (result.isDenied){
                    Livewire.emit('{{ $denyEvent }}');
                }else if(result.isDismissed){
                    if(result.dismiss == Swal.DismissReason.cancel){
                        Livewire.emit('{{ $cancelEvent }}');
                    }
                }
            });
        @endif


    @else
    //OLD SYSTEM
        @if(Session::has('success'))
            Swal.fire({
                title: "{{ __('livecontrols-alerts::alerts.success') }}",
                text: "{{ session('success') }}",
                icon: "success",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false,
                timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                timerProgressBar: true
            });
        @endif

        @if(Session::has("warning"))
            Swal.fire({
                title: "{{ __('livecontrols-alerts::alerts.warning') }}",
                text: "{{ session('warning') }}",
                icon: "warning",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false,
                timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                timerProgressBar: true
            });
        @endif

        @if(Session::has("exception"))
            Swal.fire({
                title: "{{ __('livecontrols-alerts::alerts.error') }}",
                text: "{{ session('exception') }}",
                icon: "error",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false,
                timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                timerProgressBar: true
            });
        @endif

        @if(Session::has("info"))
            Swal.fire({
                title: "{{ __('livecontrols-alerts::alerts.info') }}",
                text: "{{ session('info') }}",
                icon: "info",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false,
                timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                timerProgressBar: true
            });
        @endif

        window.addEventListener('showAlert', toastarr => {
            if(toastarr["detail"][0] == "success"){
                Swal.fire({
                    title: '{{ __('livecontrols-alerts::alerts.success') }}',
                    text: toastarr["detail"][1],
                    icon: "success",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false,
                    timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                    timerProgressBar: true
                });
            }
            if(toastarr["detail"][0] == "warning"){
                Swal.fire({
                    title: '{{ __('livecontrols-alerts::alerts.warning') }}',
                    text: toastarr["detail"][1],
                    icon: "warning",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false,
                    timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                    timerProgressBar: true
                });
            }
            if(toastarr["detail"][0] == "exception"){
                Swal.fire({
                    title: '{{ __('livecontrols-alerts::alerts.error') }}',
                    text: toastarr["detail"][1],
                    icon: "error",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false,
                    timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                    timerProgressBar: true
                });
            }
            if(toastarr["detail"][0] == "info"){
                Swal.fire({
                    title: '{{ __('livecontrols-alerts::alerts.info') }}',
                    text: toastarr["detail"][1],
                    icon: "info",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false,
                    timer: {{ config('livecontrols_alerts.default_timer', 2500) }},
                    timerProgressBar: true
                });
            }
        });
    @endif
    
    </script>
    <!-- /SWEET ALERT 2 -->
</div>