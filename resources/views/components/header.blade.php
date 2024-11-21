<nav class="fixed top-0 z-40 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow">
   <div class="px-3 py-6 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
         <div class="flex items-center space-x-3">
         </div>

         <!-- Right Section: Notification Icon, User Profile, and Menu Icon -->
         <div class="flex items-center space-x-8">
            <!-- Notification Icon -->
            <button class="text-gray-900 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white focus:outline-none">
               <i class="fa-regular fa-bell text-2xl"></i>
            </button>

            <!-- User Profile Button -->
            <div class="flex items-center relative">
               <button id="dropdownButton" type="button" class="flex items-center text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-green-600 dark:focus:ring-gray-600">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
               </button>

               <!-- Dropdown menu -->
               <div id="dropdown-user" class="hidden absolute right-0 top-12 w-48 bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600">
                  <div class="px-4 py-3" role="none">
                     <p class="text-sm text-gray-900 dark:text-white" role="none">Admin Mantap</p>
                     <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">adminmantap@gmail.com</p>
                  </div>
                  <ul class="py-1" role="none">
                     <li><a href="/profile" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a></li>
                     <li><a href="/login" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Logout</a></li>
                  </ul>
               </div>
            </div>

            <script>
               // Toggle dropdown visibility
               document.getElementById('dropdownButton').addEventListener('click', function(event) {
                  event.stopPropagation();
                  var dropdown = document.getElementById('dropdown-user');
                  dropdown.classList.toggle('hidden');
               });

               // Close the dropdown if clicked outside
               document.addEventListener('click', function(event) {
                  var dropdown = document.getElementById('dropdown-user');
                  var isClickInside = document.getElementById('dropdownButton').contains(event.target);

                  if (!isClickInside) {
                     dropdown.classList.add('hidden');
                  }
               });
            </script>

            <!-- Menu Icon for Sidebar Toggle -->
            <button type="button" class="text-gray-900 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white focus:outline-none">
               <i class="fa-solid fa-bars text-2xl"></i>
            </button>
         </div>
      </div>
   </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-6 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

      <div class="flex items-center space-x-3">
         <img src="{{ url('/image/g1.png') }}" alt="GX DOJO Logo" class="h-14 w-14">
         <div class="text-center">
            <h1 class="text-2xl font-extrabold text-green-800 shadow-text">GX DOJO</h1>
            <p class="text-sm font-semibold text-green-600 shadow-text tracking-wide">Green Energy System</p>
         </div>
      </div>

      <ul class="space-y-2 font-medium py-4">
         <li>
            <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-green-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-800 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
               </svg>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="/appliences" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-green-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-800 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Appliences</span>
            </a>
         </li>
         <li>
            <a href="/usage_by_room" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-green-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-800 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Usage by Room</span>
            </a>
         </li>
         <li>
            <a href="/emissions" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-green-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-800 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                  <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Emission</span>
            </a>
         </li>
         <li>
            <a href="/report" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-green-100 dark:hover:bg-gray-700 group">
               <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Report</span>
            </a>
         </li>
      </ul>
   </div>
</aside>