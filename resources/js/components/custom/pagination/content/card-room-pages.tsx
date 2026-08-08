import {
    PaginationComponentProps,
    Room
} from "@/types/index";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle
} from '@/components/ui/card';

function RoomCardList({ paginator }: PaginationComponentProps<Room>) {
    return (
        <div className='@container/main'>
            {/* The commented section was the default tailwind classes that not yet customed. 
                <div className='*:data-[slot=card]:from-primary/5 *:data-[slot=card]:to-card dark:*:data-[slot=card]:bg-card grid grid-cols-1 gap-4 *:data-[slot=card]:bg-gradient-to-t *:data-[slot=card]:shadow-xs @xl/main:grid-cols-2 @7xl/main:grid-cols-4'>
            */}
            <div className='*:data-[slot=card]:from-primary/5 *:data-[slot=card]:to-card dark:*:data-[slot=card]:bg-card grid grid-cols-1 gap-4 *:data-[slot=card]:bg-linear-to-t *:data-[slot=card]:shadow-xs @xl/main:grid-cols-2 @7xl/main:grid-cols-4'>
                {paginator.data.map((room, index) => {
                    return (
                        <Card className='@container/card transition-transform duration-200 hover:-translate-y-2 hover:shadow-lg' key={index}>
                            {/* 1. Tambahkan Container Gambar di sini */}
                            <div className="aspect-video w-full overflow-hidden bg-muted">
                                <img
                                    src={room.thumbnail}
                                    alt={room.name}
                                    className="h-full w-full object-cover transition-transform duration-500 hover:scale-105"
                                />
                            </div>
                            <CardHeader>
                                <CardDescription>{room.name}</CardDescription>
                                <CardTitle className='text-2xl font-extrabold tabular-nums @[250px]/card:text-4xl @[250px]/card:font-extrabold'>{room.room_code}</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <CardDescription className="text-xl font-extrabold pb-0.5">Description</CardDescription>
                                <CardDescription className="line-clamp-3">
                                    {room.description}
                                </CardDescription>
                            </CardContent>
                            <CardFooter className="grid grid-cols-1 gap-2 @[300px]/card:grid-cols-2">
                                <CardDescription className="line-clamp-1">
                                    Room Wide : {room.floor_wide_in_meter_squared} m<sup>2</sup>.
                                </CardDescription>
                                <CardDescription className="line-clamp-1">
                                    Room Height : {room.height_in_meter} m.
                                </CardDescription>
                            </CardFooter>
                        </Card>
                    );
                })}
            </div>
        </div>
    )
}

export {
    RoomCardList
}