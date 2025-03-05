<x-admin-layout>
    <div class="nav bg-white p-4 rounded-lg m-4 shadow-md flex justify-between items-center z-0">
        <h1 class="font-bold">Welcome To Dashboard</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>
    <div class="mx-4 mt-4 grid grid-cols-4 h-36 gap-6">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="top w-full px-2 pt-2 flex justify-between items-center">
                <div class="text">
                    <h1 class="font-bold text-2xl">User</h1>
                    <p>120.000</p>
                </div>
                <div class="icon bg-[#8280FF]/50 aspect-square w-12 flex justify-center items-center rounded-lg">
                    <i class="fa-solid fa-user text-2xl text-[#8280FF]"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg">
            <div class="top w-full px-2 pt-2 flex justify-between items-center">
                <div class="text">
                    <h1 class="font-bold text-2xl">User</h1>
                    <p>120.000</p>
                </div>
                <div class="icon bg-[#FEC53D]/50 aspect-square w-12 flex justify-center items-center rounded-lg">
                    <i class="fa-solid fa-user text-2xl text-[#FEC53D]"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg">
            <div class="top w-full px-2 pt-2 flex justify-between items-center">
                <div class="text">
                    <h1 class="font-bold text-2xl">User</h1>
                    <p>120.000</p>
                </div>
                <div class="icon bg-[#4AD991]/50 aspect-square w-12 flex justify-center items-center rounded-lg">
                    <i class="fa-solid fa-user text-2xl text-[#4AD991]"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg">
            <div class="top w-full px-2 pt-2 flex justify-between items-center">
                <div class="text">
                    <h1 class="font-bold text-2xl">User</h1>
                    <p>120.000</p>
                </div>
                <div class="icon bg-[#FF9066]/50 aspect-square w-12 flex justify-center items-center rounded-lg">
                    <i class="fa-solid fa-user text-2xl text-[#FF9066]"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 gap-6 h-full flex grid-flow-col mb-4 items-start justify-between ml-4 mr-4">
        <div class="h-full bg-white p-2 rounded-lg shadow-lg">
            <h2 class="text-center text-2xl font-bold mb-6">Donut Chart</h2>
            <div class="flex justify-center">
                <canvas id="donutChart" width="400" height="400"></canvas>
            </div>
        </div>

        <div class="h-full bg-white w-full p-2 rounded-lg shadow-lg">
            <h2 class="text-center text-2xl font-bold mb-6">Line Chart</h2>
            <div class="flex justify-center">
                <canvas id="lineChart" width="600" height="400"></canvas>
            </div>
        </div>
    </div>
</x-admin-layout>
