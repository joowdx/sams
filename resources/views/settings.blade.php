@extends('layouts.app')

@section('styles')
<style>
.custom-radio label {
    font-weight: normal !important;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Configurations</h3>
            </div>
                <div class="card-body">
                    <table class="table no-datatable">
                        <tbody>
                            <tr>
                                <th width="60%">Grace Period</th>
                                <td>
                                    <input type="text" id="graceperiod" value="{{ @$graceperiod->value }}" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onkeypress="this.onkeyup()"> <br>
                                    @if(@$graceperiod->updated_by)
                                        <small>Last updated by:</small>
                                        <b> {{ @$graceperiod->updated_by()->first()->name }} </b>
                                        <br>
                                        <small> {{ '@'.@$graceperiod->updated_at }} </small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th width="60%">Dark Mode</th>
                                <td>
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-radio p-0">
                                            <input type="radio" name="darkmode" value="auto" @if($settings['darkmode'] == 'auto') checked @endif>
                                            <label for="">Auto Detect <small> (Checks browser settings) </small> </label>
                                        </div>
                                        <div class="custom-control custom-radio p-0">
                                            <input type="radio" name="darkmode" value="enable" @if($settings['darkmode'] == 'enable') checked @endif>
                                            <label for="">Enable</label>
                                        </div>
                                        <div class="custom-control custom-radio p-0">
                                            <input type="radio" name="darkmode" value="disable" @if($settings['darkmode'] == 'disable' || !$settings['darkmode']) checked @endif>
                                            <label for="">Disable</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Sidebar</th>
                                <td>
                                    <div class="form-group mb-0">
                                        <label> On Load </label>
                                        <div class="custom-control custom-radio p-0">
                                            <input type="radio" name="onload" value="sidebar-collapse" @if($settings['onload'] == 'sidebar-collapse') checked @endif>
                                            <label>Collapsed</label>
                                        </div>
                                        <div class="custom-control custom-radio p-0">
                                            <input type="radio" name="onload" value="" @if(!$settings['onload']) checked @endif>
                                            <label>Shown</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label> Toggle </label>
                                        <div class="custom-control custom-radio p-0">
                                            <input type="radio" name="toggle" value="sidebar-mini" @if($settings['toggle'] == 'sidebar-mini') checked @endif>
                                            <label>Minimize</label>
                                        </div>
                                        <div class="custom-control custom-radio p-0">
                                            <input type="radio" name="toggle" value="" @if(!$settings['toggle']) checked @endif>
                                            <label>Hide</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#graceperiod').on('keyup', async function(e) {
        await axios.patch(`{{ route('settings.update', Auth::id()) }}`, {
            name: 'graceperiod',
            value: this.value,
            action: 'global',
            user: `{{ Auth::user()->id }}`,
        }).then(e => {

        });
    });

    $('input[type=radio][name=darkmode]').change(async function() {
        await axios.patch(`{{ route('settings.update', Auth::id()) }}`, {
            name: 'darkmode',
            value: this.value,
            action: 'set'
        }).then(e => {
            switch(this.value) {
                case "auto": {
                    followSystemColorScheme()
                    break;
                }
                case "enable": {
                    enableDarkMode()
                    break;
                }
                default: {
                    disableDarkMode()
                }
            }
        }).catch(e => swal.fire('Error!', 'Something went wrong.', 'error'))
    })

    $('input[type=radio][name=toggle]').change(async function() {
        await axios.patch(`{{ route('settings.update', Auth::id()) }}`, {
            name: 'toggle',
            value: this.value,
            action: 'set'
        }).then(e => {
            switch(this.value) {
                case "sidebar-mini": {
                    $('body').addClass("sidebar-mini")
                    break;
                }
                default: {
                    $('body').removeClass("sidebar-mini")
                }
            }
        }).catch(e => console.log(e))
    })

    $('input[type=radio][name=onload]').change(async function() {
        await axios.patch(`{{ route('settings.update', Auth::id()) }}`, {
            name: 'onload',
            value: this.value,
            action: 'set'
        }).then(e => {
            switch(this.value) {
                case "sidebar-collapse": {
                    $('body').addClass("sidebar-collapse")
                    break;
                }
                default: {
                    $('body').removeClass("sidebar-collapse")
                }
            }
        }).catch(e => console.log(e))
    })
})
</script>
@endsection
