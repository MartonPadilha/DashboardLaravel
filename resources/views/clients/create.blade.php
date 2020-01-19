@extends('layouts.app', ['activePage' => 'client-management', 'titlePage' => _('Gerenciador de Clientes')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('client.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Adicionar Cliente') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('client.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' Nome Inválido!' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{ old('name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('date_birth') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('date_birth') ? ' Data Inválida!' : '' }}" name="date_birth" id="input-date_birth" type="date" placeholder="{{ __('Data de Nascimento') }}" value="{{ old('date_birth') }}" required="true" aria-required="true"/>
                      @if ($errors->has('date_birth'))
                        <span id="date_birth-error" class="error text-danger" for="input-date_birth">{{ $errors->first('date_birth') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('phone') ? ' Telefone Inválido!' : '' }}" name="phone" id="phone" type="number" placeholder="{{ __('Telefone') }}" value="{{ old('phone') }}" required="true" aria-required="true"/>
                      @if ($errors->has('phone'))
                        <span id="phone-error" class="error text-danger" for="phone">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('city') ? ' Cidade inválida!' : '' }}" name="city" id="city" type="text" placeholder="{{ __('Cidade') }}" value="{{ old('city') }}" required="true" aria-required="true"/>
                        @if ($errors->has('city'))
                          <span id="city-error" class="error text-danger" for="city">{{ $errors->first('city') }}</span>
                        @endif
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="form-group{{ $errors->has('neighborhood') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('neighborhood') ? ' Bairro inválido!' : '' }}" name="neighborhood" id="neighborhood" type="text" placeholder="{{ __('Bairro') }}" value="{{ old('neighborhood') }}" required="true" aria-required="true"/>
                          @if ($errors->has('neighborhood'))
                            <span id="neighborhood-error" class="error text-danger" for="neighborhood">{{ $errors->first('neighborhood') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('address') ? ' Rua inválida!' : '' }}" name="address" id="address" type="text" placeholder="{{ __('Rua') }}" value="{{ old('address') }}" required="true" aria-required="true"/>
                          @if ($errors->has('address'))
                            <span id="address-error" class="error text-danger" for="address">{{ $errors->first('address') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="col-sm-1">
                        <div class="form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('number') ? ' Número inválido!' : '' }}" name="number" id="number" type="number" placeholder="{{ __('N') }}" value="{{ old('number') }}" required="true" aria-required="true"/>
                          @if ($errors->has('number'))
                            <span id="number-error" class="error text-danger" for="number">{{ $errors->first('number') }}</span>
                          @endif
                        </div>
                      </div>
                  </div>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Adicionar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection