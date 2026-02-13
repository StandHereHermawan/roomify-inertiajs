import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    Role,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-layout';
import RoleTable from '@/components/custom/pagination/content/table-role-pages';

export default function ({ page }: { page: Paginator<Role> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Roles Page',
            href: route('role.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPagination paginator={page} urlDestination='user.page'/>
                </div>
                <RoleTable paginator={page}></RoleTable>
            </div>
        </AppLayout>
    );
}
