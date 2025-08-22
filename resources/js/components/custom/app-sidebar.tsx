import {
    // AudioWaveform,
    // Command,
    // Frame,
    // GalleryVerticalEnd,
    // Map,
    // PieChart,
    // SquareTerminal,
    // Settings2,
    // LayoutGrid,
    // Bot,
    // Folder, 
    BookOpen, 
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


export function AppSidebar() {

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
            isActive: true,
            items: [
                {
                    icon: BookOpen,
                    title: "Dashboard 07",
                    url: route('dashboard07'),
                },
                {
                    icon: BookOpen,
                    title: "Sidebar 01",
                    url: route('sidebar01'),
                },
                {
                    icon: BookOpen,
                    title: "Sidebar 11",
                    url: route('sidebar11'),
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
                <NavAccordeon items={contentNavItems} name="Content"/>
            </SidebarContent>

            <SidebarFooter>
                <NavAccordeon items={footerNavItemsAcc}/>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
