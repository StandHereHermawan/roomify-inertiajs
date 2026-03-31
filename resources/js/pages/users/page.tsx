import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    User,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-sidebar-layout-wrapper';
import UserTable from '@/components/custom/pagination/content/table-user-pages';

export default function ({ page }: { page: Paginator<User> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Registered Users Page',
            href: route('user.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPagination paginator={page} urlDestination='user.page'/>
                </div>
                <UserTable paginator={page}></UserTable>
            </div>
        </AppLayout>
    );
}
