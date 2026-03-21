<?php
session_start();

if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'customer') {
    header("Location: index.php?error=unauthorized");
    exit();
}


require_once 'model/Database.php';
require_once 'model/Customer.php';
require_once 'model/Boat.php';

// 2. Initialize the Database connection
$database = new Database();
$db_conn = $database->getConnection();

// 3. Create the objects to fetch data
$customer = new Customer($db_conn);
$boat = new Boat($db_conn);

// 4. Fetch the data for your design
$myReservations = $customer->getCustomerReservations($_SESSION['user_email']);
$displayBoats = $boat->getAvailableBoats();

$pageTitle = "NDTBS - Customer Dashboard";
include 'src/includes/header.php';
include 'src/includes/sidebar.php'; 
?>

<section class="mt-10">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
</section>

<div class="ml-64 p-8 bg-gray-50 min-h-screen">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Welcome to Bais City</h2>
            <p class="text-gray-500">Explore our boats and beautiful dolphin-watching sceneries.</p>
        </div>
        <div class="text-sm text-gray-500">Logged in as: <strong><?= $_SESSION['user_email'] ?></strong></div>
    </header>

    <main class="space-y-10">
        <section>
            <h3 class="text-lg font-bold text-gray-700 mb-4 uppercase tracking-wider">Experience the Adventure</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                    <video class="w-full h-48 object-cover rounded-xl" controls>
                        <source src="public/assets/videos/dolphin_tour.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <p class="p-3 text-sm font-semibold text-gray-700 text-center">Dolphin Watching Highlights</p>
                </div>

                <div class="group relative bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <img src="public/assets/boats/boat1.jpg" alt="Dolphin Boat" class="w-full h-48 object-cover rounded-xl transition transform group-hover:scale-105">
                    <div class="absolute bottom-4 left-4 right-4 bg-white/80 backdrop-blur-md p-2 rounded-lg text-center">
                        <p class="text-xs font-bold text-gray-800">Our Premium Cruiser</p>
                    </div>
                </div>

                <div class="group relative bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <img src="public/assets/scenery/view1.jpg" alt="Tanjay Scenery" class="w-full h-48 object-cover rounded-xl transition transform group-hover:scale-105">
                    <div class="absolute bottom-4 left-4 right-4 bg-white/80 backdrop-blur-md p-2 rounded-lg text-center">
                        <p class="text-xs font-bold text-gray-800">Sandbar Views</p>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>

<?php include 'src/includes/footer.php'; ?>