use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

namespace test;
class HomeController
{
    public function dispatch(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        // Do your stuff here

        return $response->getBody()->write('test');
    }
}

