import {
    /// AudioWaveform,
    /// Command,
    /// Frame,
    /// GalleryVerticalEnd,
    /// Map,
    /// PieChart,
    /// SquareTerminal,
    /// Settings2,
    /// Bot,
    /// Folder, 
    LayoutGrid,
    // BookOpen,
    DoorOpen,
    Clock,
    UserCircle2Icon,
    UserCheck2Icon,
    CheckCircle,
    PlusCircleIcon,
} from "lucide-react"
import { NavUser } from '@/components/ui/old/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem
} from '@/components/ui/old/sidebar';
import { Link } from '@inertiajs/react';
import AppLogo from '../ui/old/app-logo';
/// import { NavMain as NavAccordeon } from '../custom/nav-main';
import { NavMain } from "../ui/old/nav-main";
import { NavItem } from "@/types";

export function AppSidebar() {

    const dashboardNavItems: NavItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutGrid,
        },
    ];

    const roomSessionNavItems: NavItem[] = [
        {
            title: "Room Session List",
            href: route('room.session.page'),
            icon: Clock,
        },
        {
            title: "Add Room Session",
            href: route('add.room.session.page'),
            icon: PlusCircleIcon,
        },
    ];

    const userNavItems: NavItem[] = [
        {
            title: "Registered User List",
            href: route('user.page'),
            icon: UserCircle2Icon,
        },
        {
            title: "User With Role List",
            href: route('user.with.role.page'),
            icon: UserCircle2Icon,
        },
        {
            title: "Logged Session List",
            href: route('user.session.page'),
            icon: UserCheck2Icon,
        },
        {
            title: "Role List",
            href: route('role.page'),
            icon: CheckCircle,
        },
        {
            title: "Add Role",
            href: route('add.role.page'),
            icon: PlusCircleIcon,
        },
    ];

    const roomNavItems: NavItem[] = [
        {
            title: "Room List",
            href: route('room.page'),
            icon: DoorOpen,
        },
        {
            title: "Add Room",
            href: route('add.room.page'),
            icon: PlusCircleIcon,
        },
        {
            title: "Add Room Reservation",
            href: route('add.room.reservation.page'),
            icon: PlusCircleIcon,
        },
        {
            title: "Room Reservation List",
            href: route('room.reservation.page'),
            icon: Clock,
        },
        {
            title: "Room Reservation V2 List",
            href: route('room.reservation.with.user.and.room.information.page'),
            icon: Clock,
        },
    ];

    /// Old Stuff, Not Yet Removed 4 Nov 2025
    ///
    /// const footerNavItemsAcc = [
    ///     {
    ///         title: "Docs and Repos",
    ///         url: "#",
    ///         icon: BookOpen,
    ///         isActive: false,
    ///         items: [
    ///             {
    ///                 title: "Repository",
    ///                 url: 'https://github.com/laravel/react-starter-kit',
    ///             },
    ///             {
    ///                 title: "Documentation",
    ///                 url: 'https://laravel.com/docs/starter-kits#react',
    ///             },
    ///         ],
    ///     }
    /// ];
    ///
    /// const navigationOnAccordeonItems = [
    ///     {
    ///         title: "Static Pages",
    ///         url: "#",
    ///         icon: BookOpen,
    ///         isActive: false,
    ///         items: [
    ///             {
    ///                 title: "Dashboard 07",
    ///                 url: route('dashboard07'),
    ///             },
    ///             {
    ///                 title: "Sidebar 01",
    ///                 url: route('sidebar01'),
    ///             },
    ///             {
    ///                 title: "Sidebar 11",
    ///                 url: route('sidebar11'),
    ///             },
    ///         ],
    ///     },
    ///      {
    ///          title: "Room",
    ///          url: "#",
    ///          icon: DoorOpen,
    ///          isActive: false,
    ///          items: [
    ///              {
    ///                  title: "Room Pages",
    ///                  url: route('room.page'),
    ///              },
    ///              {
    ///                  title: "Room Session Pages",
    ///                  url: route('room.session.page'),
    ///              },
    ///          ],
    ///      },
    /// ];
    ///

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={dashboardNavItems} />
                <NavMain items={roomSessionNavItems} titleSection="Room Session" />
                <NavMain items={roomNavItems} titleSection="Room Section" />
                <NavMain items={userNavItems} titleSection="User Section" />
                {/* Old Stuff, Not Yet Removed 4 Nov 2025. <NavAccordeon items={navigationOnAccordeonItems} name="Content" /> */}
            </SidebarContent>

            <SidebarFooter>
                {/* Old Stuff, Not Yet Removed 4 Nov 2025. <NavAccordeon items={footerNavItemsAcc}/> */}
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
