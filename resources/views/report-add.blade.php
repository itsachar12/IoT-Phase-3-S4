@extends('layout.mainLayout')


@section('title', 'Add Report')

@section('content')

<div class="mt-28 mb-10 ml-96">
    <a href="/report"
        class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
        Back
    </a>
</div> 
    <div class="  ml-96 bg-slate-100 rounded-lg p-5 mb-10 w-1/2 ">
        
        <h1 class="text-center text-xl font-semibold mb-2">Add New Report</h1>
        <hr>
        <form class="p-4 md:p-5" action="{{ route('report.create') }}" method="post">
            @csrf
            <div class="grid gap-4 mb-4 grid-cols-2">

                {{-- <input type="number" class="hidden" value --}}

                {{-- ? TYPE REPORT --}}
                <div class="col-span-2">
                    <label for="type_report" class="block mb-2 text-sm font-medium text-gray-900 ">Type Report</label>
                    <select id="type_report" required name="type_report" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 0 dark:border-gray-500 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" selected disabled>--Select Type Report--</option>
                        {{-- perulangan daftar appliances --}}
                        <option value="All">All</option>
                        <option value="Light">Light</option>
                        <option value="AC">AC</option>
                        {{-- <option value="Emission">Emission</option> --}}
                        
                    </select>
                </div>

                {{-- ? DESCRIPTION --}}
                <div class="col-span-2 ">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Description Report</label>
                    <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 0 dark:border-gray-500 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500" rows="5" placeholder="Report lamp this...." required></textarea>
                    
                </div>

                
                {{-- ?Periode --}}
                <div class="col-span-2">
                    <label for="periode" class="block mb-2 text-sm font-medium text-gray-900 ">Periode Time</label>
                    <select id="periode" required name="periode"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 0 dark:border-gray-500 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected value="" disabled>--Select Periode--</option>
                        {{-- perulangan daftar appliances --}}
                        <option value="A Day">A Day</option>
                        <option value="Week">Week</option>
                        <option value="Month">Month</option>
                        
                    </select>
                </div>

                {{-- ?status --}}
                

            </div>
            <button type="submit"
                class="text-white inline-flex items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Add New Report
            </button>
        </form>
    </div>

@endsection
