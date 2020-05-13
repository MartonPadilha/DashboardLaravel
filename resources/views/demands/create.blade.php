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
                      <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('date') ? ' Data inválida!' : '' }}" name="date" id="input-date" type="date" placeholder="{{ __('Data') }}" value="{{ old('date') }}" required="true" aria-required="true"/>
                        @if ($errors->has('date'))
                          <span id="date-error" class="error text-danger" for="input-date">{{ $errors->first('date') }}</span>
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

                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('product') ? ' has-danger' : '' }}">
                        <table class="products_demands">
                          <thead>
                            <tr class="col-sm-12">
                              <th style="visibility: hidden">
                                <label for="">ID</label>
                              </th>
                              <th class="col-sm-6">
                                <label for="">Produtos</label>
                              </th>
                              <th class="col-sm-2">
                                <label for="">Valor Unitário</label>
                              </th>
                              <th class="col-sm-1">
                                <label for="">Quantidade</label>
                              </th>
                              <th class="col-sm-2">
                                <label for="">Valor Total</label>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($products as $product)
                              <tr>
                                <td style="visibility: hidden">{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->value}}</td>
                                <td><input type="number"></td>
                                <td></td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <div class="col-sm-5" style="border: 1px solid black">
                      <div class="form-group{{ $errors->has('total_demand') ? ' has-danger' : '' }}">
                        <label for="">Valor Total</label>
                        <input class="form-control{{ $errors->has('total_demand') ? ' Quantidade inválida!' : '' }}" name="total_demand" id="input-total_demand" type="number" value="{{ old('date') }}" required="true" aria-required="true"/>
                        @if ($errors->has('total_demand'))
                          <span id="total_demand-error" class="error text-danger" for="input-total_demand">{{ $errors->first('total_demand') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                  

                  <script>

                    let table_products = document.querySelector('.products_demands');
                    
                    var prods = {}
                    var list = []
                    let events = ['change', 'keyup']
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
                        
                        tr.children[4].innerHTML = total_value
                        
                        total_demand += total_value;


                        if (quantity > 0) {
                          prods = {
                            product: tr.children[0].innerHTML,
                            quantity: quantity
                          }
                          list.push(prods)                          
                        }
                    }
                    document.querySelector('#input-total_demand').value = parseFloat(total_demand)

                    
                    console.log(list);
                  })
                })
                
                    // table_products.addEventListener('keyup', function(e){
                    //   let total_demand = 0;
                      
                    //   for(let i = 0; i < table_products.children[1].childElementCount; i ++){
                    //   let tr = table_products.children[1].children[i]
                    //   let value = tr.children[2].innerText;
                    //   let quantity = tr.children[3].children[0].value;
                    //   let total_value = value * quantity;
                      
                    //   tr.children[4].innerHTML = total_value
                      
                    //   total_demand += total_value; 
                    // }
                    //   document.querySelector('#input-total_demand').value = parseFloat(total_demand)
                      
                    // })

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
                    });


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