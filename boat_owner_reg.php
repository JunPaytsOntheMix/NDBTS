<?php
$pageTitle = "NDTBS - Partner Registration";
include 'src/includes/header.php'; 
?>

<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto bg-white p-10 rounded-3xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Boat Owner Application</h2>
        
        <form action="actions/boat_owner_proc.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="fname" placeholder="First Name" required class="p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
            <input type="text" name="mname" placeholder="Middle Name" class="p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
            <input type="text" name="lname" placeholder="Last Name" required class="p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
            <input type="number" name="age" placeholder="Age" required class="p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
            <input type="text" name="address" placeholder="Full Address" required class="md:col-span-2 p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
            
            <hr class="md:col-span-2 my-2 border-gray-100">

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="boat_name" placeholder="Boat Name" required class="p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="boat_name" placeholder="Boat Name" required 
            class="p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
    
            <input type="number" name="capacity" placeholder="Maximum Capacity (e.g., 15)" required 
            class="p-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
            </div>
    
            <div class="space-y-1">
            <label class="text-xs font-bold text-gray-700 uppercase">Actual Boat Photo (For Customers)</label>
            <input type="file" name="boat_image" accept="image/*" required class="text-sm w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            </div>


            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-400">BOAT LICENSE</label>
                <input type="file" name="license" required class="text-sm">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-400">VALID ID</label>
                <input type="file" name="valid_id" required class="text-sm">
            </div>
            <div class="space-y-1 md:col-span-2">
                <label class="text-xs font-bold text-gray-400">BUSINESS PERMIT</label>
                <input type="file" name="permit" required class="text-sm w-full">
            </div>

            <button type="submit" class="md:col-span-2 bg-[#90FF7E] hover:bg-[#76E664] text-gray-900 font-bold py-4 rounded-xl shadow-lg transition uppercase">
                Submit Documents for Review
            </button>
        </form>
    </div>
</div>