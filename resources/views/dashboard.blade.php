@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <table class="table table-success table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Currency Rate (for 1 {{ $baseCurrency }})</th>
                        <th>Fetched At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exchangeRates as $exchangeRate)
                        <tr>
                            <td>{{ $exchangeRate->id }}</td>
                            <td>{{ $exchangeRate->rate . ' ' . $exchangeRate->currency_iso_name}}</td>
                            <td>{{ $exchangeRate->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    {!! $exchangeRates->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
