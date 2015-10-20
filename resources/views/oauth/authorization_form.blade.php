<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<div class="col-md-6 col-md-offset-2">
{!! Form::open(['method' => 'POST','class'=>'form-horizontal', 'url'=> route('oauth.authorize.post',$params)]) !!}
<div class="form-group">
    <dl class="dl-horizontal">
        <dt>Client Name</dt>
        <dd>{{ $client->getName() }}</dd>
    </dl>
</div>
{!! Form::hidden('client_id', $params['client_id']) !!}
{!! Form::hidden('redirect_uri', $params['redirect_uri']) !!}
{!! Form::hidden('response_type', $params['response_type']) !!}
{!! Form::hidden('state', $params['state']) !!}
{!! Form::submit('Approve', ['name'=>'approve', 'value'=>1, 'class'=>'btn btn-success']) !!}
{!! Form::submit('Deny', ['name'=>'deny', 'value'=>1, 'class'=>'btn bg-danger']) !!}
{!! Form::close() !!}
</div>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>