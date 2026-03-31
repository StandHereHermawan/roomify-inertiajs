import { AppHeaderCustom } from '@/components/custom/app-header-custom';
import { AppContent } from '@/components/ui/old/app-content';
import { AppShell } from '@/components/ui/old/app-shell';
import { type BreadcrumbItem } from '@/types';
import { type PropsWithChildren } from 'react';

export default function AppHeaderLayout({ children, breadcrumbs = [] }: PropsWithChildren<{ breadcrumbs?: BreadcrumbItem[] }>) {
    return (
        <AppShell variant="header">
            <AppContent variant="header" className="overflow-x-hidden">
                < AppHeaderCustom breadcrumbs={breadcrumbs} />
                {children}
            </AppContent>
        </AppShell>
    );
}
