import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    RoomSession,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-layout';
import RoomSessionTable from '@/components/custom/pagination/content/table-room-session-pages';

export default function ({ page }: { page: Paginator<RoomSession> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Room Session Page',
            href: route('room.session.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPagination paginator={page} urlDestination='room.session.page'/>
                </div>
                <RoomSessionTable paginator={page} />
            </div>
        </AppLayout>
    );
}
