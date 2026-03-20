<?php
require_once 'model/Database.php';
$database = new Database();
$db = $database->getConnection();

// Fetching approved boats
$sql = "SELECT name, capacity, image_path FROM boats WHERE status = 'Available' ORDER BY name ASC";
$result = $db->query($sql);
?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<div class="max-w-7xl mx-auto px-6 py-12 bg-gray-50 min-h-screen">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Our Premium Fleet</h1>
            <p class="text-slate-500 mt-2 font-medium text-sm uppercase tracking-widest">Select your vessel for the adventure</p>
        </div>
        <div class="bg-blue-100 px-4 py-2 rounded-2xl">
            <span class="text-blue-700 font-bold text-sm"><?= $result->num_rows ?> Boats Available</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($boat = $result->fetch_assoc()): ?>
                
                <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                    
                    <div class="h-64 w-full bg-slate-200 relative overflow-hidden">
                        <?php if (!empty($boat['image_path'])): ?>
                            <img src="<?= htmlspecialchars($boat['image_path']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <?php else: ?>
                            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-300">
                                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-[10px] font-bold uppercase tracking-widest">No Image Available</span>
                            </div>
                        <?php endif; ?>

                        <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-md px-4 py-2 rounded-2xl flex items-center shadow-sm border border-white/20">
                             <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse mr-2"></span>
                             <span class="text-[10px] font-extrabold text-slate-700 uppercase tracking-widest">Active</span>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-xl font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors capitalize">
                                <?= htmlspecialchars($boat['name']) ?>
                            </h4>
                        </div>
                        
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="flex items-center text-xs font-bold text-slate-400 bg-slate-50 px-3 py-1.5 rounded-lg">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <?= $boat['capacity'] ?> Seater
                            </div>
                            <div class="flex items-center text-xs font-bold text-slate-400 bg-slate-50 px-3 py-1.5 rounded-lg">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Verified
                            </div>
                        </div>
                        
                        <a href="booking.php?boat=<?= urlencode($boat['name']) ?>" 
                           class="block w-full text-center py-4 bg-slate-900 text-white text-xs font-black rounded-2xl hover:bg-blue-600 shadow-lg shadow-slate-200 hover:shadow-blue-200 transition-all uppercase tracking-widest">
                            Book This Trip
                        </a>
                    </div>
                </div>

            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center">
                <div class="bg-slate-50 p-6 rounded-full mb-4">
                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <p class="text-slate-400 font-bold italic">No approved boats found in the fleet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>