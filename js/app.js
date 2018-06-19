angular.module('app', ['Controllers', 'ngRoute'])

.directive('onFinishRender', function($timeout) {
    return {
        restrict: 'A',
        link: function(scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function() {
                    scope.$emit('ngRepeatFinished');
                });
            }
        }
    }
})

.service('Utils', function($http) {
    this.collapsible = function() {
        var c = $('.collapsible').collapsible({
            accordion: false
        });
        return c;
    };
})

.service('Parceiros', function() {
    this.filtrar = function(formFiltrar) {
        var params = "";

        $('.loader').show();
        angular.forEach(formFiltrar, function(value, key) {
            if (value == true) {
                params = params + "&filtro%5bregiao%5d%5b%5d=" + key.replace('_', '%20');
            };
        });

        if (formFiltrar && formFiltrar.de != undefined) {
            var percent = '&filtro%5bpercentual_de%5d=' + formFiltrar.de;
            if (formFiltrar.ate != undefined) {
                percent = percent + '&filtro%5bpercentual_ate%5d=' + formFiltrar.ate;
            };
        };

        return params + '&' + percent;
    };
})

.run(function($rootScope) {
    $rootScope.$on("$routeChangeStart", function(event, next, current) {
        $('.loader').show();
        if (next.templateUrl == "views/home.html") {
            $rootScope.noTemplate = true;
        } else {
            $rootScope.noTemplate = false;
        }
    });
    $rootScope.$on("$routeChangeSuccess", function(event, next, current) {
        $('.loader').hide();
    });
})

.config(function($routeProvider, $locationProvider, $sceProvider, $httpProvider) {

    $sceProvider.enabled(false);

    $routeProvider

   /* .when('/enquetes', {
        templateUrl: 'views/enquetes/index.html',
        controller: 'EnquetesController'
    })

    .when('/enquete-item/:param', {
        templateUrl: 'views/enquetes/item.html',
        controller: 'EnquetesItemController'
    })
*/
    .when('/juridico', {
        templateUrl: 'views/juridico/index.html',
        controller: 'JuridicoController'
    })

    .when('/juridico-faq', {
        templateUrl: 'views/juridico/faq.html',
        controller: 'JuridicoFAQController'
    })

    .when('/juridico-faq-item/:param', {
        templateUrl: 'views/juridico/faq-item.html',
        controller: 'JuridicoFAQItemController'
    })

    .when('/juridico-duvidas', {
        templateUrl: 'views/juridico/duvidas.html',
        controller: 'JuridicoDuvidasController'
    })

    .when('/noticias', {
        templateUrl: 'views/noticias.html',
        controller: 'NoticiasController'
    })

    .when('/home', {
        templateUrl: 'views/home.html',
        controller: 'HomeController'
    })

    .when('/historia', {
        templateUrl: 'views/historia.html',
        controller: 'HistoriaController'
    })

    .when('/diretoria', {
        templateUrl: 'views/diretoria.html',
        controller: 'DiretoriaController'
    })

    .when('/presidencia', {
        templateUrl: 'views/presidencia.html',
        controller: 'PresidenciaController'
    })

    .when('/responsabilidadeSocial', {
        templateUrl: 'views/responsabilidade-social.html',
        controller: 'ResponsabilidadeSocialController'
    })

    .when('/socios', {
        templateUrl: 'views/fiqueSocio/index.html',
        controller: 'SociosIndexController'
    })

    .when('/sociosRegulamento', {
        templateUrl: 'views/fiqueSocio/regulamento.html',
        controller: 'SociosRegulamentoController'
    })

    .when('/fiqueSocio', {
        templateUrl: 'views/fiqueSocio/fiqueSocio.html',
        controller: 'FiqueSocioController'
    })

    .when('/sede', {
        templateUrl: 'views/sede.html',
        controller: 'sedeController'
    })

    .when('/subsedes', {
        templateUrl: 'views/subsedes.html',
        controller: 'subSedesController'
    })

    .when('/subSedeDetalhe/:param', {
        templateUrl: 'views/subsedeDetalhe.html',
        controller: 'subSedeDetalheController'
    })

    .when('/ambulatorios', {
        templateUrl: 'views/ambulatorios.html',
        controller: 'ambulatoriosController'
    })

    .when('/parceiros', {
        templateUrl: 'views/parceiros/index.html',
        controller: 'parceirosIndexController'
    })

    .when('/conveniosDiversos', {
        templateUrl: 'views/parceiros/conveniosDiversos.html',
        controller: 'conveniosDiversosController'
    })

    .when('/escolasECursos', {
        templateUrl: 'views/parceiros/escolasECursos.html',
        controller: 'escolasECursosController'
    })

    .when('/faculdades', {
        templateUrl: 'views/parceiros/faculdades.html',
        controller: 'faculdadesController'
    })

    .when('/coloniaDeFerias', {
        templateUrl: 'views/lazer/coloniaDeFerias/index.html',
        controller: 'coloniaDeFeriasController'
    })

    .when('/coloniaDeFeriasPrecos', {
        templateUrl: 'views/lazer/coloniaDeFerias/precos.html',
        controller: 'coloniaDeFeriasPrecosController'
    })

    .when('/coloniaDeFeriasGaleria', {
        templateUrl: 'views/lazer/coloniaDeFerias/galeria.html',
        controller: 'coloniaDeFeriasGaleriaController'
    })

    .when('/clubeDeCampo', {
        templateUrl: 'views/lazer/clubeDeCampo/index.html',
        controller: 'clubeDeCampoController'
    })

    .when('/clubeDeCampoPrecos', {
        templateUrl: 'views/lazer/clubeDeCampo/precos.html',
        controller: 'clubeDeCampoPrecosController'
    })

    .when('/clubeDeCampoGaleria', {
        templateUrl: 'views/lazer/clubeDeCampo/galeria.html',
        controller: 'clubeDeCampoGaleriaController'
    })

    .when('/faleConosco', {
        templateUrl: 'views/faleConosco/fale-conosco.html',
        controller: 'faleConoscoController'
    })

    .when('/falePresidente', {
        templateUrl: 'views/faleConosco/fale-presidente.html',
        controller: 'falePresidenteController'
    })

    .when('/denuncia', {
        templateUrl: 'views/faleConosco/denuncia.html',
        controller: 'denunciaController'
    })

    .when('/missRegulamento', {
        templateUrl: 'views/miss/missRegulamento.html',
        controller: 'missRegulamentoController'
    })

    .when('/missInscricao', {
        templateUrl: 'views/miss/missInscricao.html',
        controller: 'missInscricaoController'
    })

    .when('/vagaSocial', {
        templateUrl: 'views/curriculo/vagaSocial.html',
        controller: 'vagaSocialController'
    })

    .when('/cadastrarCurriculo', {
        templateUrl: 'views/curriculo/cadastrarCurriculo.html',
        controller: 'cadastrarCurriculoController'
    })

    .when('/curriculoPCD', {
        templateUrl: 'views/curriculo/curriculoPCD.html',
        controller: 'curriculoPCDController'
    })

    .otherwise({
        redirectTo: '/home'
    });

});