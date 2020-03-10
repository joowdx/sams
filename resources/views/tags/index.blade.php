@extends('layouts.app')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-9 col-md-6">
        <div class="card">
            <div class="card-header">Associate</div>

            <div class="card-body">
                <br>
                <form id="tagform" method="post" action="{{ route('tags.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label for="uid" class="col-md-4 col-form-label text-md-right"> UID </label>

                        <div class="col-md-6">
                            <input id="uid" type="text" class="form-control @error('uid') is-invalid @enderror" name="uid" oninput="this.value=this.value.replace(/[^\d]/,'')" readonly>
                            @error('uid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="entity" class="col-md-4 col-form-label text-md-right">Type</label>
                        <div class="col-md-6">
                            <select id="entity" class="form-control @error('entity') is-invalid @enderror" name="type" data-width="100%" disabled>
                                <option></option>
                                <option value="f"> Faculty </option>
                                <option value="s"> Student </option>
                            </select>
                            @error('entity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row" style="display: none;">
                        <label for="entities" class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <select id="entities" class="form-control @error('entities') is-invalid @enderror" name="email" name="id" data-width="100%" data-live-search="true">
                                <option></option>
                            </select>
                            @error('entities')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <a href="javascript:void(0)" id="tutorial" class="nav-link px-0 my-0 py-0">How does this work?</a>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-dark" id="update">
                                Update
                            </button>
                            <button type="button" class="btn btn-dark" id="reset">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        window.tag = (function() {

            const $uid = $('#uid')
            const $type = $('#entity')
            const $entities = $('#entities')
            const $new = $('#new-entity-checkbox')
            const $reset= $('#reset')
            const $tagform = $('#tagform')
            const $tutorial = $('#tutorial')

            $type.select2({
                placeholder: '',
                theme: 'bootstrap4',
                minimumResultsForSearch: Infinity,
            })

            $entities.select2({
                minimumInputLength: 1,
                placeholder: '',
                theme: 'bootstrap4',
                ajax: {
                    url: `{{ route('search') }}`,
                    method: 'post',
                    cache: true,
                    data: e => {
                        return {
                            entity: $type.val(),
                            search: e.term,
                        }
                    },
                }
            })

            const uid = e => $uid.val()

            const type = e => $type.val() == 's' ? 'Student' : $type.val() == 'f' ? 'Faculty' : false;

            const entity = e => $entities.val()

            const typechanged = e => {
                if(!type()) {
                    $new.removeAttr('checked')
                    $new.prop('disabled', true)
                    $new.closest('.icheck-item').addClass('disabled').removeClass('checked')
                    $entities.closest('.form-group').fadeOut()
                    $entities.val(null).trigger('change')
                    return false
                }
                $new.removeAttr('disabled')
                $new.closest('.icheck-item').removeClass('disabled')
                $entities.parent().prev().html(type())
                $entities.val(null).trigger('change')
                $entities.closest('.form-group').fadeIn()
                return type()
            }

            const newtag = async e => {
                const val = $uid.val(e.toString()).trigger('change').val()
                await $type.removeAttr('disabled')
                $type.select2('open')
                return val
            }

            const enable = e => {
                $type.removeAttr('disabled')
                $new.removeAttr('disabled')
                $entities.removeAttr('disabled')
                return true
            }

            const disable = e => {
                $type.val(null).trigger('change')
                $type.prop('disabled', true)
                $new.prop('disabled', true)
                $entities.prop('disabled', true)
                return true
            }

            const clearuid = e => {
                $uid.val('').trigger('change')
                return true
            }

            const alert = ({ title, message, type, confirm, cancel, confirmcolor, cancelcolor, showcancel }, f) => {
                return (swal.isVisible() || uid()) && f ?
                Promise.reject() :
                swal.fire({
                    title: title ?? '',
                    text: message ?? '',
                    type: type ?? 'success',
                    showCancelButton: showcancel ?? true,
                    confirmButtonColor: confirmcolor ?? '#3085d6',
                    cancelButtonColor: cancelcolor ?? '#d33',
                    confirmButtonText: confirm ?? 'Confirm',
                    cancelButtonText: cancel ?? 'Cancel',
                }).then(e => e.value ?? Promise.reject())
            }

            const tutorial = e => {
                swal.mixin({
                    confirmButtonText: 'Next <i class="fad fa-fw fa-arrow-right">',
                    showCancelButton: true,
                    type: 'info',
                    progressSteps: ['', '', '', '', '']
                }).queue([
                    {
                        title: 'Scan',
                        text: 'First, you scan your ID to the reader',
                    },
                    {
                        title: 'Confirm',
                        text: 'A pop-up like this will apear warning you and just click confirm',
                    },
                    {
                        title: 'Search',
                        html: '<p class="m-0 p-0">The uid field will now be updated and<br>just choose what type then search<br><small>Make sure they\'re already on the database</small></p>',
                    },
                    {
                        title: 'Update',
                        text: 'Now click the update button and wait for the response',
                    },
                    {
                        title: 'No alerts?',
                        html: '<p>Make sure uid field is empty<br><small>To do so, click the reset button</small></p>',
                        confirmButtonText: 'Ok, thanks! <i class="fad fa-fw fa-thumbs-up"></i>',
                        showCancelButton: false,
                    },
                    {
                        progressSteps: null,
                        title: 'Done',
                        text: 'Tutorial done, now give it a try!!',
                        type: 'success',
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 2000,
                        onBeforeOpen: () => {
                            swal.showLoading()
                            timerInterval = setInterval(() => {
                            const content = swal.getContent()
                                if (content) {
                                    const b = content.querySelector('b')
                                    if (b) {
                                        b.textContent = swal.getTimerLeft()
                                    }
                                }
                            }, 100)
                        },
                    },
                ])
            }

            const notify = ({ title }) => {
                $.notify({ title: title })
            }

            const reset = e => {
                clearuid()
                disable()
            }

            const validate = e => {
                return uid() && type() && entity() && true
            }

            const submit = e => {
                e.preventDefault()
                axios({
                    method: $tagform.attr('method'),
                    url: $tagform.prop('action'),
                    data: $tagform.serialize(),
                }).then(async ({data: e}) => {
                    await alert({
                        title: 'Success!',
                        message: `${e.uid} successfully associated to ${e.name}.`,
                        type: 'success',
                        showcancel: false,
                    }, false).catch(e => console.error(e))
                    reset()
                }).catch(e => {
                    console.error(e)
                })
            }

            $uid.on('keyup change', e => uid() ? enable() : disable())
            $type.on('change', typechanged)
            $reset.on('click', reset)
            $tagform.on('submit', submit)
            $tutorial.on('click', tutorial)

            return {
                disable: disable,
                enable: enable,
                newtag: newtag,
                alert: alert,
                notify: notify,
                reset: reset,
            }

        })()

        Echo.private('logs').listen('NewTag', async ({ tag: {uid, from, ip} }) => {
            await tag.alert({
                title: 'Accept?',
                message:`A request at ${from} from ${ip} for registration`,
                type: 'warning',
                confirm: 'Ok',
                cancel: 'Cancel',
            }).then(f => {
                tag.newtag(uid)
            }).catch(f => {
                console.error(f)
            })

        })
    })
</script>
@endsection
