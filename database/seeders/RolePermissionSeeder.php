<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define the list of roles
        $listOfRoles = ['superadmin', 'admin'];

        // Define the list of permissions (added WhyUs permissions at the end)
        $arrayOfPermissionNames = [
            'create_site_settings',
            'list_site_settings',
            'edit_site_settings',
            'delete_site_settings',
            'create_cover_images',
            'list_cover_images',
            'edit_cover_images',
            'delete_cover_images',
            'create_about_us',
            'list_about_us',
            'edit_about_us',
            'delete_about_us',
            'create_services',
            'list_services',
            'edit_services',
            'delete_services',
            'create_favicons',
            'list_favicons',
            'edit_favicons',
            'delete_favicons',
            'create_photo_galleries',
            'list_photo_galleries',
            'edit_photo_galleries',
            'delete_photo_galleries',
            'create_video_galleries',
            'list_video_galleries',
            'edit_video_galleries',
            'delete_video_galleries',
            'create_countries',
            'list_countries',
            'edit_countries',
            'delete_countries',
            'create_work_categories',
            'list_work_categories',
            'edit_work_categories',
            'delete_work_categories',
            'create_companies',
            'list_companies',
            'edit_companies',
            'delete_companies',
            'create_testimonials',
            'list_testimonials',
            'edit_testimonials',
            'delete_testimonials',
            'create_visitors_book',
            'list_visitors_book',
            'edit_visitors_book',
            'delete_visitors_book',
            'create_student_details',
            'list_student_details',
            'edit_student_details',
            'delete_student_details',
            'create_contacts',
            'list_contacts',
            'edit_contacts',
            'delete_contacts',
            'create_categories',
            'list_categories',
            'edit_categories',
            'delete_categories',
            'create_posts',
            'list_posts',
            'edit_posts',
            'delete_posts',
            'create_director_messages',
            'list_director_messages',
            'edit_director_messages',
            'delete_director_messages',
            'create_products',
            'list_products',
            'edit_products',
            'delete_products',
            'create_userdetails',
            'list_userdetails',
            'edit_userdetails',
            'delete_userdetails',
            'list_applications',
            'list_ceomessage',

            // Added WhyUs permissions
            'create_whyus',
            'list_whyus',
            'edit_whyus',
            'delete_whyus',
            
            // Added Careers permissions
            'create_careers',
            'list_careers',
            'edit_careers',
            'delete_careers',
        ];

        // Create the permissions if they do not exist
        foreach ($arrayOfPermissionNames as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // Fetch all permission names for superadmin
        $permissionsForSuperAdminRole = Permission::pluck('name')->toArray();

        // Define permissions assigned to admin role (including WhyUs)
        $permissionsForAdminRole = [
            'create_site_settings',
            'list_site_settings',
            'edit_site_settings',
            'delete_site_settings',
            'create_cover_images',
            'list_cover_images',
            'edit_cover_images',
            'delete_cover_images',
            'create_about_us',
            'list_about_us',
            'edit_about_us',
            'delete_about_us',
            'create_services',
            'list_services',
            'edit_services',
            'delete_services',
            'create_favicons',
            'list_favicons',
            'edit_favicons',
            'delete_favicons',
            'create_photo_galleries',
            'list_photo_galleries',
            'edit_photo_galleries',
            'delete_photo_galleries',
            'create_video_galleries',
            'list_video_galleries',
            'edit_video_galleries',
            'delete_video_galleries',
            'create_countries',
            'list_countries',
            'edit_countries',
            'delete_countries',
            'create_companies',
            'list_companies',
            'edit_companies',
            'delete_companies',
            'create_work_categories',
            'list_work_categories',
            'edit_work_categories',
            'delete_work_categories',
            'create_testimonials',
            'list_testimonials',
            'edit_testimonials',
            'delete_testimonials',
            'create_visitors_book',
            'list_visitors_book',
            'edit_visitors_book',
            'delete_visitors_book',
            'create_student_details',
            'list_student_details',
            'edit_student_details',
            'delete_student_details',
            'create_contacts',
            'list_contacts',
            'edit_contacts',
            'delete_contacts',
            'create_categories',
            'list_categories',
            'edit_categories',
            'delete_categories',
            'create_posts',
            'list_posts',
            'edit_posts',
            'delete_posts',
            'create_director_messages',
            'list_director_messages',
            'edit_director_messages',
            'delete_director_messages',
            'create_products',
            'list_products',
            'edit_products',
            'delete_products',
            'create_userdetails',
            'list_userdetails',
            'edit_userdetails',
            'delete_userdetails',
            'list_applications',
            'list_ceomessage',

            // Added WhyUs permissions for admin role
            'create_whyus',
            'list_whyus',
            'edit_whyus',
            'delete_whyus',
            
            // Added Careers permissions for admin role
            'create_careers',
            'list_careers',
            'edit_careers',
            'delete_careers',
        ];

        // Create or update roles and assign permissions
        foreach ($listOfRoles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            switch ($roleName) {
                case 'superadmin':
                    $role->syncPermissions($permissionsForSuperAdminRole);
                    break;
                case 'admin':
                    $role->syncPermissions($permissionsForAdminRole);
                    break;
            }
        }
    }
}
