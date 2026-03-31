import { AppContent } from '@/components/ui/old/app-content';
import { AppShell } from '@/components/ui/old/app-shell';
import { AppSidebarCustom } from '@/components/custom/app-sidebar-custom';
import { AppSidebarHeader } from '@/components/ui/old/app-sidebar-header';
import { type BreadcrumbItem } from '@/types';
import { type PropsWithChildren } from 'react';

export default function AppSidebarLayout({ children, breadcrumbs = [] }: PropsWithChildren<{ breadcrumbs?: BreadcrumbItem[] }>) {
    return (
        <AppShell variant="sidebar">
            <AppSidebarCustom />
            <AppContent variant="sidebar" className="overflow-x-hidden">
                <AppSidebarHeader breadcrumbs={breadcrumbs} />
                {children}
            </AppContent>
        </AppShell>
    );
}
