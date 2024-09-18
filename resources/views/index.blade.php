@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mb-5">Currency Exchange Rates</h1>
            <div>
                <form action="{{ route('exchange.convert') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') ?? 1 }}" step="any">
                                <span class="input-group-text" >
                                    <select class="form-control @error('from_currency') is-invalid @enderror" name="from_currency">
                                        <option value="" disabled selected>From currency</option>
                                        @foreach($currencyEnums as $currencyEnum)
                                            <option value="{{ $currencyEnum->value }}" {{ old('from_currency') ?? session('fromCurrency') === $currencyEnum->value ? 'selected' : '' }}>{{ $currencyEnum->value }}</option>
                                        @endforeach
                                    </select>
                                </span>
                                <span class="input-group-text">
                                    <span>
                                       ----->
                                    </span>
                                </span>
                                <span class="input-group-text">
                                    <select class="form-control @error('to_currency') is-invalid @enderror" name="to_currency">
                                        <option value="" disabled selected>To currency</option>
                                        @foreach($currencyEnums as $currencyEnum)
                                            <option value="{{ $currencyEnum->value }}" {{ old('to_currency') ?? session('toCurrency') === $currencyEnum->value ? 'selected' : '' }}>{{ $currencyEnum->value }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="row">
                                        <div class="col-12 text-danger {{ $loop->first ? 'mt-3' : '' }}">{{ $error }}</div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-7 mt-5">
                                <button type="submit" class="btn btn-primary float-start">Get Exchange Rate</button>
                            </div>
                        </div>
                    </div>
                </form>

                @if (session()->has('convertAmount'))
                    <div class="mt-5">
                        <div>
                            <p>
                                {{ session('fromAmount') }}  {{ session('fromCurrency') }} =
                                {{ session('convertAmount') }}  {{ session('toCurrency') }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
