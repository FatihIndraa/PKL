<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.layout.head')
</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- Sidebar -->
    @include('dashboard.layout.sidebar')

    <!-- Main Content -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>
    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endsection

    <script>
        function showDetail(image, title, description, price) {
            console.log("Function showDetail() triggered!"); // Debugging
            console.log("Image:", image);
            console.log("Title:", title);

            document.getElementById('modalImage').src = image;
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('modalPrice').innerText = 'Rp ' + price;

            var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
            detailModal.show();
        }
    </script>`
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>


</html>
