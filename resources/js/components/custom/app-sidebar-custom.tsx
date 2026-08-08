// Commented barangkali butuh grouping routing pake Ui button Accordeon.
// 
// import { NavMain as NavAccordeon } from '../custom/nav-main';
// 
import {
    LayoutGrid,
    DoorOpen,
    Clock,
    UserCircle2Icon,
    UserCheck2Icon,
    CheckCircle,
    PlusCircleIcon,
    // BookOpen,
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
import AppLogo from './ui/app-logo';
import { NavigationSection } from "../ui/custom/NavigationSection";
import { NavItem } from "@/types";

export function AppSidebarCustom() {

    const dashboardNavItems: NavItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutGrid,
        },
    ];

    const roomSessionBrowses: NavItem[] = [
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

    const userBrowses: NavItem[] = [
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

    const roomBrowses: NavItem[] = [
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
    ];

    const roomReservationBrowses: NavItem[] = [
        {
            title: "Room Reservation List",
            href: route('room.reservation.with.user.and.room.information.page'),
            icon: Clock,
        },
        {
            title: "Add Room Reservation",
            href: route('add.room.reservation.page'),
            icon: PlusCircleIcon,
        },
    ];

    /// Old Stuff, Not Yet Removed 4 Nov 2025
    ///
    // const footerNavItemsAcc = [
    //     {
    //         title: "Docs and Repos",
    //         url: "#",
    //         icon: BookOpen,
    //         isActive: false,
    //         items: [
    //             {
    //                 title: "Repository",
    //                 url: 'https://github.com/laravel/react-starter-kit',
    //             },
    //             {
    //                 title: "Documentation",
    //                 url: 'https://laravel.com/docs/starter-kits#react',
    //             },
    //         ],
    //     }
    // ];
    
    // const navigationOnAccordeonItems = [
    //     {
    //         title: "Static Pages",
    //         url: "#",
    //         icon: BookOpen,
    //         isActive: false,
    //         items: [
    //             {
    //                 title: "Dashboard 07",
    //                 url: route('dashboard07'),
    //             },
    //             {
    //                 title: "Sidebar 01",
    //                 url: route('sidebar01'),
    //             },
    //             {
    //                 title: "Sidebar 11",
    //                 url: route('sidebar11'),
    //             },
    //         ],
    //     },
    //      {
    //          title: "Room",
    //          url: "#",
    //          icon: DoorOpen,
    //          isActive: false,
    //          items: [
    //              {
    //                  title: "Room Pages",
    //                  url: route('room.page'),
    //              },
    //              {
    //                  title: "Room Session Pages",
    //                  url: route('room.session.page'),
    //              },
    //          ],
    //      },
    // ];
    
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
                <NavigationSection items={dashboardNavItems} />
                <NavigationSection items={roomSessionBrowses} titleSection="Room Session" />
                <NavigationSection items={roomBrowses} titleSection="Room Section" />
                <NavigationSection items={roomReservationBrowses} titleSection="Room Rservation Section" />
                <NavigationSection items={userBrowses} titleSection="User Section" />
                {/* Old Stuff, Not Yet Removed 4 Nov 2025.  */}
                {/* <NavAccordeon items={navigationOnAccordeonItems} name="Content" /> */}
            </SidebarContent>

            <SidebarFooter>
                {/* Old Stuff, Not Yet Removed 4 Nov 2025.  */}
                {/* <NavAccordeon items={footerNavItemsAcc}/> */}
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
