@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Search Product</div>

            <div class="card-body text-center">
                <form action="{{ route('search') }}" method="get" role="search">
                    <div class="form-group row">
                        <input type="text" class="form-control" name="q"
                               placeholder="Search with sku or name" required>
                        <span style="margin: 10px auto;" class="input-group-btn">
                            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                        </span>
                    </div>
                </form>

                @if(isset($details))
                <div class="card-header">
                    <p> The Search results for your query <b> {{ $query }} </b> are :</p>
                </div>
                <div class="card-body">
                    <h2>Product details</h2>
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Sku</th>
                                <th>Name</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $product)  
                            <tr>
                                <td>{{$product->sku}}</td>
                                <td>{{$product->name}}</td>
                                <td><a href="view?q={{$product->id}}">View</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $details->appends($_GET)->links() }}
                </div>
                @else
                @if(isset($message))
                <p>  {{ $message }}</p>
                @endif
                @endif
            </div>
            @if(isset($brands))
              <div class="brandshead text-center"><h2>Available Brands</h2></div>
              <div class="brandsbody">
                <ul>
             @foreach($brands as $brand)
               <li>{{$brand->brand}}</li>
             @endforeach
               </ul>
              </div>
            @endif
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">!! Important !!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <p>
                    Hey Fam!<br> 
                    This is used for IF PRICING ONLY. Please use Google for lowest market price and product information.<br>
                </p><p>
                    Some quick directions.<br>
                    1. Search for sku or name of item | see pricing<br>
                    2. Search online for the best price and beat it by a few dollars.<br>
                    3. Close sale. 😉<br>
                </p><p>  
                    This is all IF COST to the Manufacturer/Distributor + shipping.<br>
                </p><p>
                    <b>**PayPal 3% fee is not included**</b><br>
                </p><p>
                    Formula:<br>
                    Final Price to Cust. - 3% Paypal - Shipping - Cost = Net <br>
                    Notes for Net:<br>
                    - As long as its not negative, we're good.<br>
                    - This is where your commission is coming from. Therefore, the larger the number, the larger the commission.<br>
                </p><p>
                    Keep this in mind.<br> 
                    This is for IF eyes ONLY! Please do not share this link. <br>
                </p><p>
                    Let's make some money! <br>
                </p><p>
                    With much appreciation,<br>
                    Mike
                </p>      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default text-center" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $(window).on('load', function () {
            $('#myModal').modal('show');
        });
    });
</script>
@endpush