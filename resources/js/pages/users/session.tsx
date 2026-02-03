import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    UserSession,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-layout';
import UserSessionTable from '@/components/custom/pagination/content/table-user-session-pages';

export default function ({ page }: { page: Paginator<UserSession> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'User Session Page',
            href: route('user.session.page'),
        },
    ];

    console.log(page);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPagination paginator={page} urlDestination='user.session.page'/>
                </div>
                <UserSessionTable paginator={page}></UserSessionTable>
            </div>
        </AppLayout>
    );
}
