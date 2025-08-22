import AppLayout from '@/layouts/custom/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

export default function () {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Room Page',
            href: '/dashboard',
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
        </AppLayout>
    );
}
