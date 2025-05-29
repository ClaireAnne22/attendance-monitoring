<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Total Students -->
                <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between hover:shadow-lg transition">
                    <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                        <i class="fas fa-user-graduate text-2xl"></i>
                    </div>
                    <div class="text-right ml-4">
                        <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Student::count() }}</h3>
                        <p class="text-sm text-gray-500 font-medium">Total Students</p>
                    </div>
                </div>

                <!-- Total Subjects -->
                <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between hover:shadow-lg transition">
                    <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <div class="text-right ml-4">
                        <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Subject::count() }}</h3>
                        <p class="text-sm text-gray-500 font-medium">Total Subjects</p>
                    </div>
                </div>

                <!-- Total Students per Subject -->
                <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between hover:shadow-lg transition">
                    <div class="bg-green-100 text-green-600 p-4 rounded-full">
                        <i class="fas fa-chart-bar text-2xl"></i>
                    </div>
                    <div class="text-right ml-4">
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ \App\Models\Subject::withCount('students')->get()->max('students_count') }}
                        </h3>
                        <p class="text-sm text-gray-500 font-medium">Most Students per Subject</p>
                    </div>
                </div>
            </div>
            <br>
            <!-- Chart Section -->
            <div class="bg-white rounded-xl shadow-md p-6 max-w-4xl mx-auto">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Total Students per Subject (Bar Graph)</h3>
                <canvas id="studentsPerSubjectChart" height="100"></canvas>
            </div>

            <!-- List Section -->
            <div class="bg-white rounded-xl shadow-md p-6 max-w-4xl mx-auto">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Students per Subject</h3>
                <ul class="space-y-2">
                    @foreach(\App\Models\Subject::withCount('students')->get() as $subject)
                        <li class="text-gray-700 border-b pb-2">
                            <span class="font-medium">{{ $subject->name }}</span>: {{ $subject->students_count }} students
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('studentsPerSubjectChart').getContext('2d');

    // Subject names
    const labels = @json(\App\Models\Subject::pluck('name'));

    // Dataset 1 counts
    const dataset1 = @json(\App\Models\Subject::withCount('students')->get()->pluck('students_count'));

    // Dataset 2 counts (replace with your actual data)
    const dataset2 = dataset1.map(count => Math.round(count * 0.8));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Current Count',
                    data: dataset1,
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderRadius: 6,
                },
                {
                    label: 'Previous Count',
                    data: dataset2,
                    backgroundColor: 'rgba(139, 92, 246, 0.8)',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});
</script>

</x-app-layout>
