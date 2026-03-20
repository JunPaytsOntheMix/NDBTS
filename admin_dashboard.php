<?php
session_start();
require_once 'model/Database.php';

// Security Gate: Ensure only admins enter
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: admin_login.php?error=restricted");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// 1. Fetch Pending Boat License Applications
$licenseQuery = "SELECT * FROM boat_owners WHERE status = 'Pending' ORDER BY created_at DESC";
$licenseResult = $db->query($licenseQuery);

// 2. Fetch All Trip Bookings joined with boat_owners for the vessel name
$bookingQuery = "SELECT b.*, bt.boat_name, bt.first_name, bt.last_name 
                 FROM bookings b
                 JOIN boat_owners bt ON b.boat_id = bt.id
                 ORDER BY b.created_at DESC";
$bookingResult = $db->query($bookingQuery);

$pageTitle = "Admin Dashboard";
include 'src/includes/header.php'; 
?>

<div class="p-8 space-y-12">

    <div>
        <h2 class="text-xl font-bold text-slate-800 mb-4">Pending Boat Licenses</h2>
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="px-6 py-4">Owner</th>
                        <th class="px-6 py-4">Boat Name</th>
                        <th class="px-6 py-4">Documents</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    <?php if ($licenseResult->num_rows > 0): ?>
                        <?php while ($owner = $licenseResult->fetch_assoc()): ?>
                            <tr class="border-t border-gray-50">
                                <td class="px-6 py-4"><?= $owner['first_name'] . ' ' . $owner['last_name'] ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($owner['boat_name']) ?></td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <a href="uploads/<?= $owner['boat_license'] ?>" target="_blank" class="text-blue-500 hover:underline">License</a>
                                    <a href="uploads/<?= $owner['business_permit'] ?>" target="_blank" class="text-blue-500 hover:underline">Permit</a>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="actions/admin_verify_boat.php" method="POST" class="inline">
                                        <input type="hidden" name="id" value="<?= $owner['id'] ?>">
                                        <button name="status" value="Approved" class="text-emerald-600 font-bold hover:text-emerald-800">Approve</button>
                                        <button name="status" value="Rejected" class="ml-2 text-red-500 font-bold hover:text-red-700">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="px-6 py-10 text-center text-gray-400">No pending license applications found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <h2 class="text-xl font-bold text-slate-800 mb-4">Trip Bookings Management</h2>
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="px-6 py-4">Customer Email</th>
                        <th class="px-6 py-4">Vessel</th>
                        <th class="px-6 py-4">Preferred Date</th>
                        <th class="px-6 py-4">Status / Payment Info</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    <?php if ($bookingResult->num_rows > 0): ?>
                        <?php while ($row = $bookingResult->fetch_assoc()): ?>
                            <tr class="border-t border-gray-50 hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4"><?= $row['user_email'] ?></td>
                                <td class="px-6 py-4 font-medium text-slate-900"><?= htmlspecialchars($row['boat_name']) ?></td>
                                <td class="px-6 py-4"><?= date('M d, Y', strtotime($row['booking_date'])) ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-xs uppercase"><?= $row['status'] ?></span>
                                        <span class="text-[10px] text-gray-400">Ref: <?= $row['reference_no'] ?? 'N/A' ?> (<?= $row['payment_method'] ?? 'None' ?>)</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($row['status'] === 'Awaiting Verification' || $row['status'] === 'Pending'): ?>
                                        <form action="actions/admin_booking_proc.php" method="POST" onsubmit="showLoader()">
                                            <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                                            <button name="action" value="approve" class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs hover:bg-blue-600">Verify Payment</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-emerald-500 font-bold italic">Completed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400">No trip bookings found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>