@extends('layouts.default')
@push('styles')
    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .step-indicators {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step-indicators .step-indicator {
            flex: 1;
            text-align: center;
        }

        .step-indicators .step-indicator.active {
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
    <script
        src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.10-beta.11/dist/inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush
@section('content')
    <livewire:onboarding></livewire:onboarding>
@endsection




