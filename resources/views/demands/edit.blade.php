@extends('layouts.app', ['activePage' => 'demand-management', 'titlePage' => _('Editor de Pedido')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('demand.update', ['demand' => $demand->id]) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Pedido') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('demand.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('name') ? ' Nome Inválido!' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{$demand->name}}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('date') ? ' Data inválida!' : '' }}" name="date" id="input-date" type="date" placeholder="{{ __('Data') }}" value="{{$demand->date}}" required="true" aria-required="true"/>
                        @if ($errors->has('date'))
                          <span id="date-error" class="error text-danger" for="input-name">{{ $errors->first('date') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group{{ $errors->has('time') ? ' has-danger' : '' }}">
                        <select name="time" id="input-time" class="form-control{{ $errors->has('time') ? ' Horário Inválido!' : '' }}" required>
                            @if ($demand->time_take == "10:30")
                                <option value="10:30">10:30</option>
                                <option value="11:20">11:20</option>
                                <option value="12:10">12:10</option> 
                            @elseif ($demand->time_take == "11:20")
                                <option value="11:20">11:20</option>
                                <option value="10:30">10:30</option>
                                <option value="12:10">12:10</option> 
                            @else
                                <option value="12:10">12:10</option> 
                                <option value="10:30">10:30</option>
                                <option value="11:20">11:20</option>
                            @endif
                        </select>
                        {{-- <input class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{ old('name') }}" required="true" aria-required="true"/> --}}
                        @if ($errors->has('name'))
                          <span id="time-error" class="error text-danger" for="input-time">{{ $errors->first('time') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group{{ $errors->has('product') ? ' has-danger' : '' }}">
                        <select name="product" id="input-product" class="form-control{{ $errors->has('product') ? ' Produto Inválido' : '' }}" required onchange="calc()">
                            @if ($demand->product == "Frango Inteiro")
                                <option value="Frango Inteiro">Frango Inteiro</option>
                                <option value="1/2 Frango">1/2 Frango</option>
                            @else
                                <option value="1/2 Frango">1/2 Frango</option>
                                <option value="Frango Inteiro">Frango Inteiro</option>
                            @endif
                        </select>
                        @if ($errors->has('product'))
                          <span id="product-error" class="error text-danger" for="input-product">{{ $errors->first('product') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('quantity') ? ' Quantidade inválida!' : '' }}" name="quantity" id="input-quantity" type="number" placeholder="{{ __('Quantidade') }}" value="{{$demand->quantity}}" required="true" aria-required="true" onchange="calc()"/>
                        @if ($errors->has('quantity'))
                          <span id="quantity-error" class="error text-danger" for="input-quantity">{{ $errors->first('quantity') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group{{ $errors->has('value') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('value') ? ' Valor inválido!' : '' }}" name="value" id="input-value" type="number" value="{{$demand->value}}" placeholder="{{ __('Valor') }}" required="true" aria-required="true"/>
                        @if ($errors->has('value'))
                          <span id="value-error" class="error text-danger" for="input-value">{{ $errors->first('value') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <script>
                    function calc(){
                      let select = document.querySelector('#input-product')
                      let option = select.options[select.selectedIndex];
                      let quantity = Number(document.querySelector('#input-quantity').value)
                      if (option.value == "Frango Inteiro") {
                        document.querySelector('#input-value').value = quantity * 30
                      } else {
                        document.querySelector('#input-value').value = quantity * 20
                      }
                    }
                  </script>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection