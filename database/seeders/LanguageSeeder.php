<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add English as default language
        $english = Language::create([
            'name' => 'English',
            'lang' => 'en',
            'slug' => 'english',
            'default' => true,
            'status' => true,
        ]);

        // Add Amharic language
        $amharic = Language::create([
            'name' => 'Amharic',
            'lang' => 'am',
            'slug' => 'amharic',
            'default' => false,
            'status' => true,
        ]);

        // Create language directories if they don't exist
        $langPath = resource_path('lang');
        
        if (!File::exists($langPath . '/en')) {
            File::makeDirectory($langPath . '/en', 0755, true);
        }
        
        if (!File::exists($langPath . '/am')) {
            File::makeDirectory($langPath . '/am', 0755, true);
        }

        // Create default messages files if they don't exist
        if (!File::exists($langPath . '/en/messages.php')) {
            File::put($langPath . '/en/messages.php', $this->getDefaultEnglishMessages());
        }
        
        if (!File::exists($langPath . '/am/messages.php')) {
            File::put($langPath . '/am/messages.php', $this->getDefaultAmharicMessages());
        }
    }

    /**
     * Get default English messages
     */
    private function getDefaultEnglishMessages(): string
    {
        return '<?php

return [
    // General
    "home" => "Home",
    "about" => "About",
    "contact" => "Contact",
    "products" => "Products",
    "categories" => "Categories",
    "search" => "Search",
    "login" => "Login",
    "register" => "Register",
    "logout" => "Logout",
    "my_account" => "My Account",
    "cart" => "Cart",
    "wishlist" => "Wishlist",
    "checkout" => "Checkout",
    "orders" => "Orders",
    "language" => "Language",
    "currency" => "Currency",
    
    // Product related
    "add_to_cart" => "Add to Cart",
    "add_to_wishlist" => "Add to Wishlist",
    "buy_now" => "Buy Now",
    "price" => "Price",
    "quantity" => "Quantity",
    "availability" => "Availability",
    "in_stock" => "In Stock",
    "out_of_stock" => "Out of Stock",
    "description" => "Description",
    "reviews" => "Reviews",
    "related_products" => "Related Products",
    
    // User account
    "profile" => "Profile",
    "edit_profile" => "Edit Profile",
    "change_password" => "Change Password",
    "address" => "Address",
    "billing_address" => "Billing Address",
    "shipping_address" => "Shipping Address",
    
    // Admin panel
    "dashboard" => "Dashboard",
    "settings" => "Settings",
    "users" => "Users",
    "vendors" => "Vendors",
    "customers" => "Customers",
    "sales" => "Sales",
    "reports" => "Reports",
    "languages" => "Languages",
    "add_language" => "Add Language",
    "edit_language" => "Edit Language",
    "language_name" => "Language Name",
    "language_code" => "Language Code",
    "default_language" => "Default Language",
    "status" => "Status",
    "active" => "Active",
    "inactive" => "Inactive",
    "save" => "Save",
    "cancel" => "Cancel",
    "delete" => "Delete",
    "edit" => "Edit",
    "actions" => "Actions",
    
    // Messages
    "success" => "Success",
    "error" => "Error",
    "warning" => "Warning",
    "info" => "Information",
    "confirm_delete" => "Are you sure you want to delete this item?",
    "item_created" => "Item created successfully",
    "item_updated" => "Item updated successfully",
    "item_deleted" => "Item deleted successfully",
    "language_created" => "Language created successfully",
    "language_updated" => "Language updated successfully",
    "language_deleted" => "Language deleted successfully",
    "default_language_changed" => "Default language changed successfully",
    "cannot_delete_default_language" => "Cannot delete default language",
];
';
    }

    /**
     * Get default Amharic messages
     */
    private function getDefaultAmharicMessages(): string
    {
        return '<?php

return [
    // General
    "home" => "ቤት",
    "about" => "ስለ እኛ",
    "contact" => "አግኙን",
    "products" => "ምርቶች",
    "categories" => "ምድቦች",
    "search" => "ፈልግ",
    "login" => "ግባ",
    "register" => "ተመዝገብ",
    "logout" => "ውጣ",
    "my_account" => "የእኔ መለያ",
    "cart" => "ጋሪ",
    "wishlist" => "የምርጫ ዝርዝር",
    "checkout" => "ክፍያ አጠናቅቅ",
    "orders" => "ትዕዛዞች",
    "language" => "ቋንቋ",
    "currency" => "ገንዘብ",
    
    // Product related
    "add_to_cart" => "ወደ ጋሪ አክል",
    "add_to_wishlist" => "ወደ ምርጫ ዝርዝር አክል",
    "buy_now" => "አሁን ግዛ",
    "price" => "ዋጋ",
    "quantity" => "ብዛት",
    "availability" => "ተገኝነት",
    "in_stock" => "አለ",
    "out_of_stock" => "አልተገኘም",
    "description" => "መግለጫ",
    "reviews" => "ግምገማዎች",
    "related_products" => "ተዛማጅ ምርቶች",
    
    // User account
    "profile" => "መገለጫ",
    "edit_profile" => "መገለጫ አስተካክል",
    "change_password" => "የይለፍ ቃል ቀይር",
    "address" => "አድራሻ",
    "billing_address" => "የክፍያ አድራሻ",
    "shipping_address" => "የመላኪያ አድራሻ",
    
    // Admin panel
    "dashboard" => "ዳሽቦርድ",
    "settings" => "ቅንብሮች",
    "users" => "ተጠቃሚዎች",
    "vendors" => "አቅራቢዎች",
    "customers" => "ደንበኞች",
    "sales" => "ሽያጮች",
    "reports" => "ሪፖርቶች",
    "languages" => "ቋንቋዎች",
    "add_language" => "ቋንቋ አክል",
    "edit_language" => "ቋንቋ አስተካክል",
    "language_name" => "የቋንቋ ስም",
    "language_code" => "የቋንቋ ኮድ",
    "default_language" => "ነባሪ ቋንቋ",
    "status" => "ሁኔታ",
    "active" => "ንቁ",
    "inactive" => "ንቁ ያልሆነ",
    "save" => "አስቀምጥ",
    "cancel" => "ሰርዝ",
    "delete" => "አጥፋ",
    "edit" => "አስተካክል",
    "actions" => "ድርጊቶች",
    
    // Messages
    "success" => "ተሳክቷል",
    "error" => "ስህተት",
    "warning" => "ማስጠንቀቂያ",
    "info" => "መረጃ",
    "confirm_delete" => "ይህን ንጥል መሰረዝ እንደሚፈልጉ እርግጠኛ ነዎት?",
    "item_created" => "ንጥል በተሳካ ሁኔታ ተፈጥሯል",
    "item_updated" => "ንጥል በተሳካ ሁኔታ ተዘምኗል",
    "item_deleted" => "ንጥል በተሳካ ሁኔታ ተሰርዟል",
    "language_created" => "ቋንቋ በተሳካ ሁኔታ ተፈጥሯል",
    "language_updated" => "ቋንቋ በተሳካ ሁኔታ ተዘምኗል",
    "language_deleted" => "ቋንቋ በተሳካ ሁኔታ ተሰርዟል",
    "default_language_changed" => "ነባሪ ቋንቋ በተሳካ ሁኔታ ተቀይሯል",
    "cannot_delete_default_language" => "ነባሪ ቋንቋን መሰረዝ አይቻልም",
];
';
    }
}