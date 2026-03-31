import {
    Paginator,
    Room,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppHeaderWrapper from '@/layouts/custom/app-header-layout-wrapper';
import { CustomPaginationNavigation } from '@/components/custom/pagination/navigation-pagination';
import { RoomCardList } from '@/components/custom/pagination/content/card-room-pages';

export default function ({ page }: { page: Paginator<Room> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Home Page',
            href: '',
        },
    ];

    return (
        <AppHeaderWrapper breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPaginationNavigation paginator={page} urlDestination='room.page' />
                </div>
                <RoomCardList paginator={page} />
            </div>
        </AppHeaderWrapper>
    );
}
