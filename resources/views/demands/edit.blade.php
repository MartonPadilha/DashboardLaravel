@extends('layouts.app', ['activePage' => 'demand-management', 'titlePage' => _('Gerenciador de Pedidos')])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" autocomplete="off" class="form-horizontal">
            {{-- action="{{ route('demand.update', ['demand' => $demands->id]) }}" --}}
            @csrf
            @method('PUT')

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
                      <input list="clients" name="autoclient" id="autoclient" class="form-control{{ $errors->has('client') ? ' Cliente inválido!' : '' }}" value="{{$demands->clients->name}}">
                      <div class="autoclient_list"></div>
                      @if ($errors->has('client'))
                      <span id="client-error" class="error text-danger" for="input-client">{{ $errors->first('client') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                      <label for="input-date">Data de Entrega</label>
                      <input class="form-control{{ $errors->has('date') ? ' Data inválida!' : '' }}" name="date" id="input-date" type="date" placeholder="{{ __('Data') }}" value="{{$demands->date}}" required="true" aria-required="true"/>
                      @if ($errors->has('date'))
                        <span id="date-error" class="error text-danger" for="input-date">{{ $errors->first('date') }}</span>
                      @endif
                    </div>
                  </div>
                  
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('time') ? ' has-danger' : '' }}">
                      <label for="input-time">Hora de Entrega</label>
                      <input class="form-control{{ $errors->has('time') ? ' Hora inválida!' : '' }}" name="time" id="input-time" type="time" placeholder="{{ __('Hora') }}" value="{{$demands->time_take}}" required="true" aria-required="true"/>
                      @if ($errors->has('time'))
                        <span id="time-error" class="error text-danger" for="input-time">{{ $errors->first('time') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <div class="table-responsive">
                        <table class="products_demands table">
                          <thead class="text-primary">
                            <tr class="col-sm-12">
                              <th style="visibility: hidden">
                                <label for="">ID</label>
                              </th>
                              <th class="col-sm-5">
                                <label for="">Produto</label>
                              </th>
                              <th class="col-sm-2">
                                <label for="">Valor</label>
                              </th>
                              <th class="col-sm-1">
                                <label for="">Quantidade</label>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($products as $product)
                            {{-- utilizado php puro para o codigo não aparecer no html --}}
                           <?php $i = 0 ?> 
                              <tr>
                                <td style="visibility: hidden">{{$product->id}}</td>
                                <td>{{$product->name}} {{$product->quantity}} {{$product->ums->initials}}</td>
                                <td>{{$product->value}}</td>
                                @foreach ($demands->products as $item)
                                  @if ($item->id == $product->id)
                                  <?php $i++?> 
                                  @endif
                                @endforeach
                                <td><input type="number" id="quantity" value={{$i}}></td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="form-group{{ $errors->has('total_demand') ? ' has-danger' : '' }}">
                        <label for="input-total_demand" class="text-center">Valor Total</label>
                      <div id="input-total_demand">{{$demands->value}}</div>
                        @if ($errors->has('total_demand'))
                          <span id="total_demand-error" class="error text-danger" for="input-total_demand">{{ $errors->first('total_demand') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
                  

                  <script>

                    let table_products = document.querySelector('.products_demands');
                    
                    var prods = {}
                    var list = []
                    let events = ['change', 'keyup']

                    //CALCULA VALORES DOS PRODUTOS E DO PEDIDO
                    events.forEach(function(event){
                      table_products.addEventListener(event, function(){
                         prods = {}
                         list = []
                        
                        let total_demand = 0;
                      
                      for(let i = 0; i < table_products.children[1].childElementCount; i ++){
                        let tr = table_products.children[1].children[i]
                        let value = tr.children[2].innerText;
                        let quantity = tr.children[3].children[0].value;
                        let total_value = value * quantity;
                        
                        total_demand += total_value;

                        if (quantity > 0) {
                          prods = {
                            product: tr.children[0].innerHTML,
                            quantity: quantity
                          }
                          list.push(prods)                          
                        }
                    }

                    document.querySelector('#input-total_demand').innerHTML = parseFloat(total_demand)


                  })
                })
                
                //AUTOCOMPLETES
                    $(document).ready(function () {
                      //auto complete de clientes
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

                    // auto complete de produtos
                    $('#autoproduct').on('keyup',function() {
                            var query = $(this).val();                                        
                            $.ajax({
                                url:"{{ route('product.autocomplete') }}",
                                type:"GET",
                                data:{'product':query},
                                success:function (data) {
                                    let products = data.split('/')//coloquei isso para tornar os valores um array de objetos
                                    let list = $('#products')[0]//aqui pega meu datalist html
                                    products.pop()//aqui retiro o ultimo elemento do array, que estava retornando vazio
                                    products.forEach(product => {//percorro o array de produtos
                                      prod = product.split(';')//aqui separo o nome do produto do id
                                      let option = jQuery('<option/>', {// alimento o valor e o id em "<option>" que vai dentro do datalist
                                        id: prod[1] , //pego o id do produto
                                        value: prod[0] // nome do produto
                                      })
                                      option.appendTo(list) //adiciono o option dentro do meu datalist
                                  });
                                }
                            })
                        });

                        $(document).on('click', 'li', function(){
                            var value = $(this).text();
                            $('.autoproduct').val(value);
                            $('.autoproduct_list').html("");
                        });
                    });
                  </script>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary" id="send_button">{{ __('Salvar') }}</button>
              </div>

              <script>
                let send_button = document.querySelector('#send_button');
                send_button.addEventListener('click', function(e){
                  e.preventDefault();
                  prods = {}
                  list = []
                  for(let i = 0; i < table_products.children[1].childElementCount; i ++){
                        let tr = table_products.children[1].children[i]
                        let value = tr.children[2].innerText;
                        let quantity = tr.children[3].children[0].value;
                        // let total_value = value * quantity;
                        
                        // tr.children[4].innerHTML = total_value

                        if (quantity > 0) {
                          prods = {
                            product: tr.children[0].innerHTML,
                            quantity: quantity
                          }
                          list.push(prods);                 
                        }
                    }


                    var client = $("input[name='autoclient'").val();
                    var date = $("input[name='date'").val();
                    var time = $("input[name='time'").val();
                    var total_demand = $("#input-total_demand").text();

                    $.ajaxSetup({
                          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                        });

            $.ajax({
              url: "{{route('demand.update', ['demand' => $demands->id])}}",
              type: 'put',
              data: {
                  client: client, 
                  date: date,
                  time: time,
                  value: total_demand,
                  list: list
                },
              dataType: 'json',
              // beforeSend: function(){
              //     $(".messageBox").addClass('loading')
              // },
              success: function(response){
                if (response.success) {
                  // $('.messageBox').removeClass('loading')
                  window.location.href = "{{route('demand.index')}}"
                  
                } else {
                  console.log('Erro')
                  
                  // $('.messageBox').removeClass('loading')
                  // $('.messageBox').removeClass('d-none').html(response.message)
                }
              }
            })
                });
              </script>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <style>
    #input-total_demand{
      color: gray;
      font-size: 110px;
      text-align: center;
      align-items: center;
      margin-top: 10%;
      margin-bottom: 10%;
    }

    #quantity{
      border: none;
      width: 100%;
      align-items: center
    }
  </style>
@endsection