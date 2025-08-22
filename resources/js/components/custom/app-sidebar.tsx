import {
    // AudioWaveform,
    // Command,
    // Frame,
    // GalleryVerticalEnd,
    // Map,
    // PieChart,
    // SquareTerminal,
    // Settings2,
    // Bot,
    // Folder, 
    LayoutGrid,
    BookOpen,
    DoorOpen, 
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
import { NavMain as NavAccordeon } from '../custom/nav-main';
import { NavMain } from "../ui/old/nav-main";
import { NavItem } from "@/types";

export function AppSidebar() {

    const mainNavItems: NavItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutGrid,
        },
    ];

    const footerNavItemsAcc = [
        {
            title: "Docs and Repos",
            url: "#",
            icon: BookOpen,
            isActive: false,
            items: [
                {
                    title: "Repository",
                    url: 'https://github.com/laravel/react-starter-kit',
                },
                {
                    title: "Documentation",
                    url: 'https://laravel.com/docs/starter-kits#react',
                },
            ],
        }
    ];

    const contentNavItems = [
        {
            title: "Static Pages",
            url: "#",
            icon: BookOpen,
            isActive: false,
            items: [
                {
                    title: "Dashboard 07",
                    url: route('dashboard07'),
                },
                {
                    title: "Sidebar 01",
                    url: route('sidebar01'),
                },
                {
                    title: "Sidebar 11",
                    url: route('sidebar11'),
                },
            ],
        },
        {
            title: "Room",
            url: "#",
            icon: DoorOpen,
            isActive: false,
            items: [
                {
                    title: "Room Pages",
                    url: route('room.page'),
                },
            ],
        },
    ];

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
                <NavMain items={mainNavItems} />
                <NavAccordeon items={contentNavItems} name="Content"/>
            </SidebarContent>

            <SidebarFooter>
                <NavAccordeon items={footerNavItemsAcc}/>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
