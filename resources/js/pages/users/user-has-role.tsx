import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-sidebar-layout-wrapper';
import UserWithRoleTable from '@/components/custom/pagination/content/table-user-with-role-pages';

export default function ({ page }: { page: Paginator<unknown> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Registered Users With Role Page',
            href: route('user.with.role.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPagination paginator={page} urlDestination='user.with.role.page'/>
                </div>
                <UserWithRoleTable paginator={page}></UserWithRoleTable>
            </div>
        </AppLayout>
    );
}
