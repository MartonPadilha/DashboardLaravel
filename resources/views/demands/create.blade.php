@extends('layouts.app', ['activePage' => 'demand-management', 'titlePage' => _('Gerenciador de Pedidos')])

@section('content')
<style>
  .chip .close{
    cursor: pointer;
    float: right;
    font-size: 16px;
    line-height: 32px;
    padding-left: 8px;
  }
  .chip {
    display: inline-block;
    height: 32px;
    font-size: 13px;
    font-weight: 500;
    color: rgba(0,0,0,0.6);
    line-height: 32px;
    padding: 0 12px;
    border-radius: 16px;
    background-color: #e4e4e4;
    margin-bottom: 5px;
    margin-right: 5px
}
</style>
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('demand.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Adicionar Pedido') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('demand.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('client') ? ' has-danger' : '' }}">
                      <label for="input-client">Cliente</label>
                      <input list="clients" name="autoclient" id="autoclient" class="form-control{{ $errors->has('client') ? ' Cliente inválido!' : '' }}">
                      <div class="autoclient_list"></div>
                      @if ($errors->has('client'))
                      <span id="client-error" class="error text-danger" for="input-client">{{ $errors->first('client') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('date') ? ' Data inválida!' : '' }}" name="date" id="input-date" type="date" placeholder="{{ __('Data') }}" value="{{ old('date') }}" required="true" aria-required="true"/>
                        @if ($errors->has('date'))
                          <span id="date-error" class="error text-danger" for="input-name">{{ $errors->first('date') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group{{ $errors->has('time') ? ' has-danger' : '' }}">
                        <select name="time" id="input-time" class="form-control{{ $errors->has('time') ? ' Horário Inválido!' : '' }}" required>
                          <option value="10:30">10:30</option>
                          <option value="11:20">11:20</option>
                          <option value="12:10">12:10</option>
                        </select>
                        @if ($errors->has('name'))
                          <span id="time-error" class="error text-danger" for="input-time">{{ $errors->first('time') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group{{ $errors->has('product') ? ' has-danger' : '' }}">
                        <label for="">Produtos</label>
                        <input list="products" name="autoproduct" id="autoproduct" class="form-control{{ $errors->has('client') ? ' Cliente inválido!' : '' }}">
                        <div class="autoproduct_list">
                          <datalist id="products">

                          </datalist>
                        </div>
                        <div class="products_added"></div>
                        <button class="btn btn-sm btn-primary add_product"><span class="material-icons">add_circle_outline</span></button>
                        @if ($errors->has('product'))
                          <span id="product-error" class="error text-danger" for="input-product">{{ $errors->first('product') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('quantity') ? ' Quantidade inválida!' : '' }}" name="quantity" id="input-quantity" type="number" placeholder="{{ __('Quantidade') }}" value="{{ old('date') }}" required="true" aria-required="true" onchange="calc()"/>
                        @if ($errors->has('quantity'))
                          <span id="quantity-error" class="error text-danger" for="input-quantity">{{ $errors->first('quantity') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group{{ $errors->has('value') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('value') ? ' Valor inválido!' : '' }}" name="value" id="input-value" type="number" placeholder="{{ __('Valor') }}" value="{{ old('date') }}" required="true" aria-required="true"/>
                        @if ($errors->has('value'))
                          <span id="value-error" class="error text-danger" for="input-value">{{ $errors->first('value') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                  

                  <script>
                    $(document).ready(function () {
                        $('#autoclient').on('keyup',function() {
                            var query = $(this).val();                                        
                            $.ajax({
                                url:"{{ route('client.autocomplete') }}",
                                type:"GET",
                                data:{'client':query},
                                success:function (data) {
                                    $('.autoclient_list').html(data);
                                }
                            })
                        });

                        $(document).on('click', 'li', function(){
                            var value = $(this).text();
                            $('.autoclient').val(value);
                            $('.autoclient_list').html("");
                        });
                    // });

                    // $('datalist#products').remove()
                    $('#autoproduct').on('keyup',function() {
                            var query = $(this).val();                                        
                            $.ajax({
                                url:"{{ route('product.autocomplete') }}",
                                type:"GET",
                                data:{'product':query},
                                success:function (data) {
                                  let products = data.split('/')
                                  let list = $('#products')[0]
                                 products.forEach(product => {
                                  prod = product.split(';')
                                  // output = $.create('option')
                                  // output.attr('value', prod[0])
                                  // console.log(output);
                                  jQuery('<option/>', {
                                    value: prod[0] 
                                  }).appendTo(list)
                                  
                                  // output = <option value={prod[0]}>
                                  // list.append(output)
                                  });
                                  console.log(list);

                                  
                                  // data.split('-')
                                  // product_name = data[0]
                                  // product_id = data[1]
                                  //   $('.autoproduct_list').html(product_name);
                                }
                            })
                        });

                        $(document).on('click', 'li', function(){
                            var value = $(this).text();
                            $('.autoproduct').val(value);
                            $('.autoproduct_list').html("");
                        });
                    });

                    let btn_add_product = document.querySelector('.add_product')
                    btn_add_product.addEventListener('click', function(e){
                      e.preventDefault()
                      let product = document.querySelector('#autoproduct').value
                      let products_added = document.querySelector('.products_added')
                      products_added.insertAdjacentHTML('afterEnd', 
                        `<div class="chip">
                            <div id='id_product'>${product}<i class="close material-icons">close</i></div>                          
                          </div>`
                        )
                      product.innerHTML = ''
                    })

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
                <button type="submit" class="btn btn-primary">{{ __('Adicionar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection