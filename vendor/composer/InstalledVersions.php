<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;








class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => '6df73409d1845755c540a7062570ad2f96a91881',
    'name' => 'flarum/flarum',
  ),
  'versions' => 
  array (
    'antoinefr/flarum-ext-money' => 
    array (
      'pretty_version' => 'v0.12.0',
      'version' => '0.12.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8b21be5d9aca56d267567a96bf15af40ce466f59',
    ),
    'askvortsov/flarum-categories' => 
    array (
      'pretty_version' => 'v2.1.1',
      'version' => '2.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '368b3812a0f0c8bc9298a5fa6211ed7de99224b4',
    ),
    'askvortsov/flarum-discussion-templates' => 
    array (
      'pretty_version' => 'v0.7.0',
      'version' => '0.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '38013cfb3194546944507ad74ae2f297f3b8de1a',
    ),
    'askvortsov/flarum-help-tags' => 
    array (
      'pretty_version' => 'v0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '70a3246538f6026f30f24f7ee650bfbe91b25cfe',
    ),
    'askvortsov/flarum-moderator-warnings' => 
    array (
      'pretty_version' => 'v0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3655d6445ad773a2fec65d37a3d770d28183f854',
    ),
    'askvortsov/flarum-pwa' => 
    array (
      'pretty_version' => 'v2.4.1',
      'version' => '2.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '97287fde4b6013136dbcba12cd0c053fd463c5eb',
    ),
    'askvortsov/flarum-rich-text' => 
    array (
      'pretty_version' => 'v1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c0c6a82b16528cef02a5f76624362b56f8a34bb7',
    ),
    'askvortsov/flarum-trust-levels' => 
    array (
      'pretty_version' => 'v0.2.1',
      'version' => '0.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd34a941ae42b1bb4b5adf2e598b1fa100f0ef6aa',
    ),
    'avatar4eg/flarum-ext-share-social' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'aws/aws-sdk-php' => 
    array (
      'pretty_version' => '3.181.2',
      'version' => '3.181.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ca4839367aa57de005d52593081eab777b87a6b0',
    ),
    'axy/backtrace' => 
    array (
      'pretty_version' => '1.0.7',
      'version' => '1.0.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6c7d0f3497a07ae934f9e8511cbc2286db311c5',
    ),
    'axy/codecs-base64vlq' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '53a1957f2cb773c6533ac615b3f1ac59e40e13cc',
    ),
    'axy/errors' => 
    array (
      'pretty_version' => '1.0.5',
      'version' => '1.0.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '2c64374ae2b9ca51304c09b6b6acc275557fc34f',
    ),
    'axy/sourcemap' => 
    array (
      'pretty_version' => '0.1.5',
      'version' => '0.1.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '95a52df5a08c3a011031dae2e79390134e28467c',
    ),
    'behat/transliterator' => 
    array (
      'pretty_version' => 'v1.3.0',
      'version' => '1.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3c4ec1d77c3d05caa1f0bf8fb3aae4845005c7fc',
    ),
    'bertaveira/flarum-pt-pt' => 
    array (
      'pretty_version' => 'v1.2.0',
      'version' => '1.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e5934e844546d660a62bccfa79cee53de951fd0c',
    ),
    'brick/math' => 
    array (
      'pretty_version' => '0.9.2',
      'version' => '0.9.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dff976c2f3487d42c1db75a3b180e2b9f0e72ce0',
    ),
    'clarkwinkelmann/catch-the-fish' => 
    array (
      'pretty_version' => '0.1.3',
      'version' => '0.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'df2af7c98e339c39183b9e94908ab824a6f4a93d',
    ),
    'clarkwinkelmann/flarum-ext-author-change' => 
    array (
      'pretty_version' => '0.2.3',
      'version' => '0.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '12409758686a5da9556bc091d5b20ae85315ef1a',
    ),
    'clarkwinkelmann/flarum-ext-create-user-modal' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '3428c5a200f29b28d6d07444ebb70b3f4ec97ab9',
    ),
    'clarkwinkelmann/flarum-ext-emojionearea' => 
    array (
      'pretty_version' => '0.3.1',
      'version' => '0.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd10ac24ab195d7e357042484e11b9f8e07c91363',
    ),
    'clarkwinkelmann/flarum-ext-first-post-approval' => 
    array (
      'pretty_version' => '0.1.4',
      'version' => '0.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e70e523934358619b8bdb63864bec20060c33202',
    ),
    'clarkwinkelmann/flarum-ext-post-date' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'components/font-awesome' => 
    array (
      'pretty_version' => '5.15.3',
      'version' => '5.15.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '09f1f2e02ea0cd319569b32f8639b37dfcd7a62d',
    ),
    'cryental/flarum-l10n-ext-korean' => 
    array (
      'pretty_version' => '1.1',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1b3c374acd899db9dafe5bf27f51ce2de6c5273d',
    ),
    'csineneo/lang-traditional-chinese' => 
    array (
      'pretty_version' => '1.13.1',
      'version' => '1.13.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '46aaaf33419a721a38e211fb3c4f44a439061cc9',
    ),
    'cwkevo/flarum-lang-slovak' => 
    array (
      'pretty_version' => 'v0.1.0-beta.15.1',
      'version' => '0.1.0.0-beta15.1',
      'aliases' => 
      array (
      ),
      'reference' => 'bdb792df6c2a260d2c422aeda58c475e67b36b41',
    ),
    'darkfoxdeveloper/lang-spanish' => 
    array (
      'pretty_version' => 'v1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c18379073355718702f3b5bba67d736374e0c7b7',
    ),
    'davis/flarum-ext-socialprofile' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'dem13n/discussion-cards' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '55fa0fea048eab95af368a4a89497472030e7d50',
    ),
    'dflydev/fig-cookies' => 
    array (
      'pretty_version' => 'v3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ea6934204b1b34ffdf5130dc7e0928d18ced2498',
    ),
    'doctrine/cache' => 
    array (
      'pretty_version' => '1.11.0',
      'version' => '1.11.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a9c1b59eba5a08ca2770a76eddb88922f504e8e0',
    ),
    'doctrine/dbal' => 
    array (
      'pretty_version' => '2.13.1',
      'version' => '2.13.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c800380457948e65bbd30ba92cc17cda108bf8c9',
    ),
    'doctrine/deprecations' => 
    array (
      'pretty_version' => 'v0.5.3',
      'version' => '0.5.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9504165960a1f83cc1480e2be1dd0a0478561314',
    ),
    'doctrine/event-manager' => 
    array (
      'pretty_version' => '1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '41370af6a30faa9dc0368c4a6814d596e81aba7f',
    ),
    'doctrine/inflector' => 
    array (
      'pretty_version' => '2.0.3',
      'version' => '2.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9cf661f4eb38f7c881cac67c75ea9b00bf97b210',
    ),
    'doctrine/lexer' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e864bbf5904cb8f5bb334f99209b48018522f042',
    ),
    'dragonmantank/cron-expression' => 
    array (
      'pretty_version' => 'v3.1.0',
      'version' => '3.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7a8c6e56ab3ffcc538d05e8155bb42269abf1a0c',
    ),
    'egulias/email-validator' => 
    array (
      'pretty_version' => '2.1.25',
      'version' => '2.1.25.0',
      'aliases' => 
      array (
      ),
      'reference' => '0dbf5d78455d4d6a41d186da50adc1122ec066f4',
    ),
    'ffans/lang-simplified-chinese' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16.2',
      'version' => '0.1.0.0-beta16.2',
      'aliases' => 
      array (
      ),
      'reference' => '33ef56137bfcc1b64ee3111a4516c0809cdd7983',
    ),
    'fgribreau/mailchecker' => 
    array (
      'pretty_version' => 'v4.0.7',
      'version' => '4.0.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '72b5ba8492acd4ee10fd8b94687be988219ed376',
    ),
    'fgrosse/phpasn1' => 
    array (
      'pretty_version' => 'v2.3.0',
      'version' => '2.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '20299033c35f4300eb656e7e8e88cf52d1d6694e',
    ),
    'fig/http-message-util' => 
    array (
      'pretty_version' => '1.1.5',
      'version' => '1.1.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '9d94dc0154230ac39e5bf89398b324a86f63f765',
    ),
    'filp/whoops' => 
    array (
      'pretty_version' => '2.12.1',
      'version' => '2.12.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c13c0be93cff50f88bbd70827d993026821914dd',
    ),
    'flagrow/byobu' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flagrow/flarum-ext-analytics' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flagrow/html-errors' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flagrow/linguist' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flagrow/sitemap' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flagrow/terms' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flagrow/upload' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flagrow/user-directory' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flarum/approval' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '6331da4a2aa77b1435cdb1b078f6c2c9683aa07a',
    ),
    'flarum/auth-facebook' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flarum/auth-github' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flarum/auth-twitter' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'flarum/bbcode' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => 'e2c5c28829b30d3a05ea175a359fc4415219e45c',
    ),
    'flarum/core' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '9fffb8ec1a15926b5ee10c052224e5cc8035b6f5',
    ),
    'flarum/embed' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '6f4345b7da072e45c6f08f4ae68e75464d49a124',
    ),
    'flarum/emoji' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '1f9356087457da90799d6601edec002d1a9873f6',
    ),
    'flarum/flags' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '53465badf825392f402f70702dc5c5660a1bac76',
    ),
    'flarum/flarum' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => '6df73409d1845755c540a7062570ad2f96a91881',
    ),
    'flarum/lang-english' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => 'aec3e4f9b39d61caf63d601306b35e57828fce12',
    ),
    'flarum/likes' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '975739e8bfc762405348c0b4822442126e0d5932',
    ),
    'flarum/lock' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => 'c4383c318899fce6d5e7c936695edbe5f7f49c88',
    ),
    'flarum/markdown' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16.1',
      'version' => '0.1.0.0-beta16.1',
      'aliases' => 
      array (
      ),
      'reference' => '88e41c73a28f48f24fe346ed3a1d35ec11455d3b',
    ),
    'flarum/mentions' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '21b885fdca94a9088a2fed1146c0961188d10e52',
    ),
    'flarum/nicknames' => 
    array (
      'pretty_version' => '0.1.0-beta.16.1',
      'version' => '0.1.0.0-beta16.1',
      'aliases' => 
      array (
      ),
      'reference' => '1c72993c6345baea5131296288b87dd641a91142',
    ),
    'flarum/pusher' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => 'ce8c3b789e52ca7c003c68092774be53fd750988',
    ),
    'flarum/statistics' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '2179b16b8d0200d798f05b476bf3a9c3e8764639',
    ),
    'flarum/sticky' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => 'c421777bdd39354952e6e58f650afc44a51b3660',
    ),
    'flarum/subscriptions' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => 'b19d49c5726e8f56dd2395cf9f97897179939cf8',
    ),
    'flarum/suspend' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '46ff4bc08e9888e6aa28df00c96ec989adcde724',
    ),
    'flarum/tags' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => '2582358a00e6edbce847336276406ae80a3a6106',
    ),
    'fof/analytics' => 
    array (
      'pretty_version' => '0.12.0',
      'version' => '0.12.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bde964f841b9c49886c645d37ffa5a50af70c5e2',
    ),
    'fof/auth-discord' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'fof/auth-gitlab' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'fof/ban-ips' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '41d64ec897495d39c17038c9abaae2c44e579fb4',
    ),
    'fof/bbcode-details' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3b397747d5ba50ae7db2d3e9d5d6d91b65166112',
    ),
    'fof/best-answer' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bc88c85bbbb2d5e344e310b7ea91c31b29188274',
    ),
    'fof/byobu' => 
    array (
      'pretty_version' => 'dev-dk/beta-16',
      'version' => 'dev-dk/beta-16',
      'aliases' => 
      array (
      ),
      'reference' => 'd34541c963eb9c41471ee68ddbe1a0f90ef7cbc1',
    ),
    'fof/components' => 
    array (
      'pretty_version' => '0.2.0',
      'version' => '0.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '395c8b1729421ebda22aa46c9de2667b9e44e97e',
    ),
    'fof/console' => 
    array (
      'pretty_version' => '0.7.0',
      'version' => '0.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '90d944ee596c48efe5f5c9e21c4d307daea63896',
    ),
    'fof/cookie-consent' => 
    array (
      'pretty_version' => '0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cc50a271bc32a5333e57eaa84b04a5a4a9d7f5df',
    ),
    'fof/default-group' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '623ad04ce17fea5afa8413f5512c6697bb131256',
    ),
    'fof/default-user-preferences' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ebd672fa704dd1b3924ff8c0d6ced996fda320e9',
    ),
    'fof/discussion-language' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '4c54d7bff3528bb3624884ff9faea2b98e3e1431',
    ),
    'fof/discussion-thumbnail' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '367a20e42b427ce34121bbd95ca6ff15d8af8255',
    ),
    'fof/disposable-emails' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c1183a230ada5e46b4377b4c43a6141653cc42f2',
    ),
    'fof/doorman' => 
    array (
      'pretty_version' => '0.4.1',
      'version' => '0.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8733475d52b9ea7b20d01b4f1fa3253a2dd640b8',
    ),
    'fof/drafts' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ce6092e01046ce267dc6ccd807e32e9d93831676',
    ),
    'fof/extend' => 
    array (
      'pretty_version' => '0.3.1',
      'version' => '0.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '9fc079d3b1c4c98c87fb252b4df12d5b2033458e',
    ),
    'fof/filter' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8b4c0899d9af06ae005aa67f96eb635c09cb8803',
    ),
    'fof/formatting' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '834a5bcdf1e500dfcec958a2b12e79feefc938ca',
    ),
    'fof/forum-statistics-widget' => 
    array (
      'pretty_version' => '0.6.0',
      'version' => '0.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '560bfe405806f5c094749c318dec0af82481e45b',
    ),
    'fof/gamification' => 
    array (
      'pretty_version' => '0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5f35ab591645906945bee0cee97ea58736c029b1',
    ),
    'fof/html-errors' => 
    array (
      'pretty_version' => '0.6.0',
      'version' => '0.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'eca5b302218acd2b962f60ed96fd0bc5f862d4e2',
    ),
    'fof/ignore-users' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c4332b3674f62da601bfa72dd2a0e0536ea1e917',
    ),
    'fof/linguist' => 
    array (
      'pretty_version' => '0.6.0',
      'version' => '0.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7cd1bde62ee0b7fdade933a348f10c4a531878f3',
    ),
    'fof/links' => 
    array (
      'pretty_version' => '0.6.0',
      'version' => '0.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3aba6d3d04edf6cdb1dbf2a76e625ff2d19dcddc',
    ),
    'fof/merge-discussions' => 
    array (
      'pretty_version' => '0.5.1',
      'version' => '0.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fa19cdf16b439d43f28a34fb9c586e8550ca09f0',
    ),
    'fof/nightmode' => 
    array (
      'pretty_version' => '0.8.0',
      'version' => '0.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a3d7614537f0e270e0a7a0ea745db8d0294a6c9e',
    ),
    'fof/oauth' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '4f96747caaa84c3235ac690854698ec8e7d1dee9',
    ),
    'fof/pages' => 
    array (
      'pretty_version' => '0.7.0',
      'version' => '0.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '82ab30faf714bb22d46a2d666474e442481d48be',
    ),
    'fof/polls' => 
    array (
      'pretty_version' => '0.4.1',
      'version' => '0.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'eba85565fa6088576cc870d754468305c14dc63d',
    ),
    'fof/pretty-mail' => 
    array (
      'pretty_version' => '0.4.0',
      'version' => '0.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '094877155017126eeca9fbca8afface4acb121e0',
    ),
    'fof/prevent-necrobumping' => 
    array (
      'pretty_version' => '0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3f47eef3121e0e8ed5bc40179fe092214ab360ef',
    ),
    'fof/profile-image-crop' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c52d12e130befd1455ed2495179f57e659020954',
    ),
    'fof/reactions' => 
    array (
      'pretty_version' => '0.6.0',
      'version' => '0.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd1147b891d3fd9352a13e02d36daae21dcf0e88c',
    ),
    'fof/share-social' => 
    array (
      'pretty_version' => '0.3.1',
      'version' => '0.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e5a2d8a86ef905b8af262d62f0cee06857b2312e',
    ),
    'fof/sitemap' => 
    array (
      'pretty_version' => '0.7.0',
      'version' => '0.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dc6ae8bf2fdf83832d9ff009bf8ec3aaee472a0e',
    ),
    'fof/socialprofile' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '324cf97dbb8cdeaaf397e07c17ec76a0fa62b079',
    ),
    'fof/spamblock' => 
    array (
      'pretty_version' => '0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '41c80861c0373c4590e2ad49cd93a81b14a60a65',
    ),
    'fof/split' => 
    array (
      'pretty_version' => '0.7.0',
      'version' => '0.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1fae4e73780d49dd9b3990da03af8e772f8dcdc5',
    ),
    'fof/stopforumspam' => 
    array (
      'pretty_version' => '0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e98af2ea1633bc948995c9f9ced8abfa3ce5bfd1',
    ),
    'fof/terms' => 
    array (
      'pretty_version' => '0.6.2',
      'version' => '0.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '9f6611649bf09ac189485589d004e2f0f738a0be',
    ),
    'fof/transliterator' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '95e49e261fd900af5c0f5dbeddfc02e6aefd3fdb',
    ),
    'fof/upload' => 
    array (
      'pretty_version' => '0.14.0',
      'version' => '0.14.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6051bbfe30329be03fcc0b87420e7fa6c5fb393b',
    ),
    'fof/user-bio' => 
    array (
      'pretty_version' => '0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bb263c677aa79fb3b3750dd7d9631d4c68e11aad',
    ),
    'fof/user-directory' => 
    array (
      'pretty_version' => '0.6.2',
      'version' => '0.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '59afed6882dcdf2d109a1c0326d169a471179cf6',
    ),
    'fof/username-request' => 
    array (
      'pretty_version' => '0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8fe79258e8defa37304bd03946625708b22b2847',
    ),
    'fof/webhooks' => 
    array (
      'pretty_version' => '0.5.1',
      'version' => '0.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '0b3bf41324b18226268d6692a26e0c7aaef944bd',
    ),
    'franzl/whoops-middleware' => 
    array (
      'pretty_version' => '2.0.0',
      'version' => '2.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '71d75c5fff75587d6194a051d510a9eca0e3a047',
    ),
    'guzzlehttp/guzzle' => 
    array (
      'pretty_version' => '7.3.0',
      'version' => '7.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7008573787b430c1c1f650e3722d9bba59967628',
    ),
    'guzzlehttp/promises' => 
    array (
      'pretty_version' => '1.4.1',
      'version' => '1.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8e7d04f1f6450fef59366c399cfad4b9383aa30d',
    ),
    'guzzlehttp/psr7' => 
    array (
      'pretty_version' => '1.8.2',
      'version' => '1.8.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dc960a912984efb74d0a90222870c72c87f10c91',
    ),
    'html2text/html2text' => 
    array (
      'pretty_version' => '4.3.1',
      'version' => '4.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '61ad68e934066a6f8df29a3d23a6460536d0855c',
    ),
    'ianm/html-head' => 
    array (
      'pretty_version' => '0.2.0',
      'version' => '0.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '012597454fbd64d7732007ccadb42161ec5690e6',
    ),
    'ianm/iso-639' => 
    array (
      'pretty_version' => '1.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1dff6806fcb714ff62e3d20efea21d92383d5a6d',
    ),
    'ianm/synopsis' => 
    array (
      'pretty_version' => '0.2.0',
      'version' => '0.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0dff3bfb76aa4fccd00f47e38926cade7d686c25',
    ),
    'illuminate/bus' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7b5c0f1aa52cc70259352ff6b7adb67c7d46bcc5',
    ),
    'illuminate/cache' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '267a541171a375d56622117fbd0a60515402f2ef',
    ),
    'illuminate/collections' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'deccb956d38710f3f8baf36dd876c3fa1585ec22',
    ),
    'illuminate/config' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8441c542312b4d57220b1f942b947b6517c05008',
    ),
    'illuminate/console' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '395002ac2d4ec404c42e6e97997f4236dc8ab2b6',
    ),
    'illuminate/container' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0e38ee1632d470e56aece0079e6e22d13e6bea8e',
    ),
    'illuminate/contracts' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '64abbe2aeee0855a11cfce49d0ea08a0aa967cd2',
    ),
    'illuminate/database' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6277b39728bce436d2509d215223137d87265792',
    ),
    'illuminate/events' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bd2941d4d55f5d357b203dc2ed81ac5c138593dc',
    ),
    'illuminate/filesystem' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8ef5902052c5b3bb4a6c1c3afc399f30e7723cb8',
    ),
    'illuminate/hashing' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e0541364324c4cc165d4fd54afade571e1bb1626',
    ),
    'illuminate/macroable' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '300aa13c086f25116b5f3cde3ca54ff5c822fb05',
    ),
    'illuminate/mail' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6e2af3a60ac68669ee302fdc98501f55980b653f',
    ),
    'illuminate/pipeline' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '23aeff5b26ae4aee3f370835c76bd0f4e93f71d2',
    ),
    'illuminate/queue' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ecb4913c86349c64cdb09e3912042446855a02d7',
    ),
    'illuminate/session' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5fee71ca59ce9f8c89ea78a0a2904fcefca772f4',
    ),
    'illuminate/support' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '31e91a12f0aac770d02a05b5d5771829132213b4',
    ),
    'illuminate/translation' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0fffa8b8f6eed8b4e17eac9d457befbcbae02b47',
    ),
    'illuminate/validation' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '337da4b6891906fe7017adef929512267bb50ab6',
    ),
    'illuminate/view' => 
    array (
      'pretty_version' => 'v8.41.0',
      'version' => '8.41.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '696a1d6d2213be192429e97245a3d2bb4d6d1849',
    ),
    'intervention/image' => 
    array (
      'pretty_version' => '2.5.1',
      'version' => '2.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'abbf18d5ab8367f96b3205ca3c89fb2fa598c69e',
    ),
    'itnt/flarum-uitab' => 
    array (
      'pretty_version' => 'v0.3.3',
      'version' => '0.3.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '4e182e9895e8b99108bd5ff1e51eeea8884adf8a',
    ),
    'jslirola/flarum-ext-login2seeplus' => 
    array (
      'pretty_version' => 'v0.1.9.1',
      'version' => '0.1.9.1',
      'aliases' => 
      array (
      ),
      'reference' => 'd847863554f5a4f69266028383c5298f4fb116aa',
    ),
    'kakifrucht/flarum-de' => 
    array (
      'pretty_version' => '0.14.3',
      'version' => '0.14.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ee9ed874cf6202d3202a6b559cc5fb4c7028031f',
    ),
    'kakifrucht/flarum-de-extended' => 
    array (
      'pretty_version' => '0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cf871e3c39c9dfba4d0e2dc1a98f3751906a3580',
    ),
    'laminas/laminas-diactoros' => 
    array (
      'pretty_version' => '2.5.1',
      'version' => '2.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '53df7b7cd66e0905e6133970a4b90392a7a08075',
    ),
    'laminas/laminas-escaper' => 
    array (
      'pretty_version' => '2.7.0',
      'version' => '2.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5e04bc5ae5990b17159d79d331055e2c645e5cc5',
    ),
    'laminas/laminas-httphandlerrunner' => 
    array (
      'pretty_version' => '1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6a2dd33e4166469ade07ad1283b45924383b224b',
    ),
    'laminas/laminas-stratigility' => 
    array (
      'pretty_version' => '3.3.0',
      'version' => '3.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd6336b873fe8f766f84b82164f2a25e4decd6a9a',
    ),
    'laminas/laminas-zendframework-bridge' => 
    array (
      'pretty_version' => '1.2.0',
      'version' => '1.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6cccbddfcfc742eb02158d6137ca5687d92cee32',
    ),
    'laravel/helpers' => 
    array (
      'pretty_version' => 'v1.4.1',
      'version' => '1.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'febb10d8daaf86123825de2cb87f789a3371f0ac',
    ),
    'lcobucci/clock' => 
    array (
      'pretty_version' => '2.0.0',
      'version' => '2.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '353d83fe2e6ae95745b16b3d911813df6a05bfb3',
    ),
    'lcobucci/jwt' => 
    array (
      'pretty_version' => '4.1.4',
      'version' => '4.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '71cf170102c8371ccd933fa4df6252086d144de6',
    ),
    'league/commonmark' => 
    array (
      'pretty_version' => '1.6.2',
      'version' => '1.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '7d70d2f19c84bcc16275ea47edabee24747352eb',
    ),
    'league/flysystem' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9be3b16c877d477357c015cec057548cf9b2a14a',
    ),
    'league/flysystem-aws-s3-v3' => 
    array (
      'pretty_version' => '1.0.29',
      'version' => '1.0.29.0',
      'aliases' => 
      array (
      ),
      'reference' => '4e25cc0582a36a786c31115e419c6e40498f6972',
    ),
    'league/mime-type-detection' => 
    array (
      'pretty_version' => '1.7.0',
      'version' => '1.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3b9dff8aaf7323590c1d2e443db701eb1f9aa0d3',
    ),
    'league/oauth1-client' => 
    array (
      'pretty_version' => 'v1.9.0',
      'version' => '1.9.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1e7e6be2dc543bf466236fb171e5b20e1b06aee6',
    ),
    'league/oauth2-client' => 
    array (
      'pretty_version' => '2.6.0',
      'version' => '2.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'badb01e62383430706433191b82506b6df24ad98',
    ),
    'league/oauth2-facebook' => 
    array (
      'pretty_version' => '2.0.5',
      'version' => '2.0.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '14cead7580cab8caace67f5a61ea5d2a8ff213eb',
    ),
    'league/oauth2-github' => 
    array (
      'pretty_version' => '2.0.0',
      'version' => '2.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e63d64f3ec167c09232d189c6b0c397458a99357',
    ),
    'league/oauth2-google' => 
    array (
      'pretty_version' => '3.0.4',
      'version' => '3.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '6b79441f244040760bed5fdcd092a2bda7cf34c6',
    ),
    'league/oauth2-linkedin' => 
    array (
      'pretty_version' => '5.1.2',
      'version' => '5.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f9ab661ca37884067ca286412b6c17304d3c2fac',
    ),
    'littlegolden/flarum-lang-japanese' => 
    array (
      'pretty_version' => 'v0.1.67.1',
      'version' => '0.1.67.1',
      'aliases' => 
      array (
      ),
      'reference' => '486cfc05ce331c70d520ea8f7eae2b5942a23ee6',
    ),
    'littlegolden/flarum-lang-simplified-chinese' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'luatdolphin/lang-vietnamese' => 
    array (
      'pretty_version' => '0.1.0-beta.14',
      'version' => '0.1.0.0-beta14',
      'aliases' => 
      array (
      ),
      'reference' => 'a1e1d6473d036e0a0f404ad4a759bcde59a6a2b4',
    ),
    'luuhai48/oauth-google' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'luuhai48/oauth-linkedin' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'madnest/flarum-lang-czech' => 
    array (
      'pretty_version' => 'v0.1.0-beta.14.1',
      'version' => '0.1.0.0-beta14.1',
      'aliases' => 
      array (
      ),
      'reference' => '462fbe672444ffcdeabe624bf3302443d6902291',
    ),
    'maicol07/flarum-ext-sso' => 
    array (
      'pretty_version' => '1.9',
      'version' => '1.9.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9745f9f88bef061ab2dbbecb348942f99d1a87ca',
    ),
    'malago/flarum-achievements' => 
    array (
      'pretty_version' => '0.2.8',
      'version' => '0.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '51fd1ae05bf5b4522a6d670de29b3095bfb2d375',
    ),
    'marketplace/flarum-l10n-core-russian' => 
    array (
      'pretty_version' => '0.1.0-beta.16-1',
      'version' => '0.1.0.0-beta16-1',
      'aliases' => 
      array (
      ),
      'reference' => 'ff9aab51aabd28dd47806088b09eb0b332d71e8e',
    ),
    'marketplace/flarum-l10n-ext-russian' => 
    array (
      'pretty_version' => '0.1.18',
      'version' => '0.1.18.0',
      'aliases' => 
      array (
      ),
      'reference' => '4ee0c16a070764e1942a40bc3c4b99a2ba254688',
    ),
    'matteocontrini/flarum-imgur-upload' => 
    array (
      'pretty_version' => 'v3.8.0',
      'version' => '3.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7447b079e690cbbda0e581537bcd61b340190724',
    ),
    'matthiasmullie/minify' => 
    array (
      'pretty_version' => '1.3.66',
      'version' => '1.3.66.0',
      'aliases' => 
      array (
      ),
      'reference' => '45fd3b0f1dfa2c965857c6d4a470bea52adc31a6',
    ),
    'matthiasmullie/path-converter' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e7d13b2c7e2f2268e1424aaed02085518afa02d9',
    ),
    'menomenta/flarum-ext-norwegian' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '86237c48e154659d29a562ffaecd9c03fa948cb7',
    ),
    'michaelbelgium/flarum-discussion-views' => 
    array (
      'pretty_version' => 'v6.0.1',
      'version' => '6.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '66212a9ad8f4da254c433cfb7a6984c29fdf939a',
    ),
    'michaelbelgium/flarum-dutch' => 
    array (
      'pretty_version' => 'v9.1.0',
      'version' => '9.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1190a2af551d2e94caa2d4cea7d597ff9391286d',
    ),
    'middlewares/base-path' => 
    array (
      'pretty_version' => 'v2.1.0',
      'version' => '2.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9540b7b3aea29f22be269ad4c182455e70e38b4a',
    ),
    'middlewares/base-path-router' => 
    array (
      'pretty_version' => 'v2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '36e3860cfd917ad51d10e238f82796c8b2504908',
    ),
    'middlewares/request-handler' => 
    array (
      'pretty_version' => 'v2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e5563184b4c9eab81ecb58c6ef530516559e8488',
    ),
    'middlewares/utils' => 
    array (
      'pretty_version' => 'v3.2.0',
      'version' => '3.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a9ef1e5365020ead0ae343b95602bd877a9bf852',
    ),
    'migratetoflarum/canonical' => 
    array (
      'pretty_version' => '0.2.4',
      'version' => '0.2.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a499a62e77939fd4e7d525afd7567aaa8717d1da',
    ),
    'minishlink/web-push' => 
    array (
      'pretty_version' => 'v6.0.5',
      'version' => '6.0.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd87e9e3034ca2b95b1822b1b335e7761c14b89f6',
    ),
    'monolog/monolog' => 
    array (
      'pretty_version' => '1.26.0',
      'version' => '1.26.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '2209ddd84e7ef1256b7af205d0717fb62cfc9c33',
    ),
    'mtdowling/cron-expression' => 
    array (
      'replaced' => 
      array (
        0 => '^1.0',
      ),
    ),
    'mtdowling/jmespath.php' => 
    array (
      'pretty_version' => '2.6.0',
      'version' => '2.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '42dae2cbd13154083ca6d70099692fef8ca84bfb',
    ),
    'nearata/flarum-ext-no-self-likes' => 
    array (
      'pretty_version' => 'v1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '354af292788c8011cdad4b5846d1c0c6d87e9aab',
    ),
    'nearata/lang-italian' => 
    array (
      'pretty_version' => 'v0.1.0-beta.16',
      'version' => '0.1.0.0-beta16',
      'aliases' => 
      array (
      ),
      'reference' => 'bd48f8f5cafde5af0a000f891c36b186c682fff7',
    ),
    'neercsys/flarum-ext-bosanski' => 
    array (
      'pretty_version' => 'v0.39',
      'version' => '0.39.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6ebd3913cf4929ea2da6d125c87e77bdef64bb29',
    ),
    'neercsys/flarum-lang-bosanski' => 
    array (
      'pretty_version' => 'v0.19',
      'version' => '0.19.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '84d785c60fd0aafa5f3387f6210b68b6edae6f3d',
    ),
    'nesbot/carbon' => 
    array (
      'pretty_version' => '2.48.0',
      'version' => '2.48.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd3c447f21072766cddec3522f9468a5849a76147',
    ),
    'nikic/fast-route' => 
    array (
      'pretty_version' => 'v0.6.0',
      'version' => '0.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '31fa86924556b80735f98b294a7ffdfb26789f22',
    ),
    'nomiscz/flarum-ext-auth-steam' => 
    array (
      'pretty_version' => 'v0.2.1',
      'version' => '0.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bd63a746ee293b15ed5e38fd5a0955603949283d',
    ),
    'omines/oauth2-gitlab' => 
    array (
      'pretty_version' => '3.4.0',
      'version' => '3.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0c37361c54fae71a85350c445bda1834db5859af',
    ),
    'opis/closure' => 
    array (
      'pretty_version' => '3.6.2',
      'version' => '3.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '06e2ebd25f2869e54a306dda991f7db58066f7f6',
    ),
    'paragonie/random_compat' => 
    array (
      'pretty_version' => 'v9.99.100',
      'version' => '9.99.100.0',
      'aliases' => 
      array (
      ),
      'reference' => '996434e5492cb4c3edcb9168db6fbb1359ef965a',
    ),
    'persianfla/flarum-ext-persian' => 
    array (
      'pretty_version' => 'v0.0.1',
      'version' => '0.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '38ebe5dc24be598a653eda1bc14212c51897f310',
    ),
    'piotr-tokarczyk/flarum-user-default-preferences' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'psr/container' => 
    array (
      'pretty_version' => '1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8622567409010282b7aeebe4bb841fe98b58dcaf',
    ),
    'psr/container-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/event-dispatcher' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dbefd12671e8a14ec7f180cab83036ed26714bb0',
    ),
    'psr/event-dispatcher-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-client' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
    ),
    'psr/http-client-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-factory' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
    ),
    'psr/http-factory-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
    ),
    'psr/http-message-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-server-handler' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'aff2f80e33b7f026ec96bb42f63242dc50ffcae7',
    ),
    'psr/http-server-middleware' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2296f45510945530b9dceb8bcedb5cb84d40c5f5',
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.4',
      'version' => '1.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd49695b909c3b7628b6289db5479a1c204601f11',
    ),
    'psr/log-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0.0',
        1 => '1.0',
      ),
    ),
    'psr/simple-cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
    ),
    'pusher/pusher-php-server' => 
    array (
      'pretty_version' => '2.6.4',
      'version' => '2.6.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '2cf2ba85e7ce3250468a1c42ab7c948a7d43839d',
    ),
    'qiaeru/lang-french' => 
    array (
      'pretty_version' => 'v1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8bc616cd50647a76e4b82e5c10d5d10090bedc18',
    ),
    'ralouphie/getallheaders' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '120b605dfeb996808c31b6477290a714d356e822',
    ),
    'ramsey/collection' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '28a5c4ab2f5111db6a60b2b4ec84057e0f43b9c1',
    ),
    'ramsey/uuid' => 
    array (
      'pretty_version' => '4.1.1',
      'version' => '4.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cd4032040a750077205918c86049aa0f43d22947',
    ),
    'realodix/flarum-ext-indonesian' => 
    array (
      'pretty_version' => '1.16.2',
      'version' => '1.16.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '92e3544d719cd1422c100ea3f76221eb7db0e89b',
    ),
    'reflar/cookie-consent' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'reflar/doorman' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'reflar/gamification' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'reflar/nightmode' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'reflar/polls' => 
    array (
      'replaced' => 
      array (
        0 => '^1.3.4',
      ),
    ),
    'reflar/pretty-mail' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'reflar/reactions' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'reflar/stopforumspam' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'reflar/webhooks' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'rhumsaa/uuid' => 
    array (
      'replaced' => 
      array (
        0 => '4.1.1',
      ),
    ),
    'rikusen0335/lang-japanese-extended' => 
    array (
      'pretty_version' => 'v1.6.0',
      'version' => '1.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5f5e1985f810ac2a865511bd8aee2f04812653d9',
    ),
    'rinvex/countries' => 
    array (
      'pretty_version' => 'v7.3.2',
      'version' => '7.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '4696d23976e27d6cedf7e55db3fa24e11924b727',
    ),
    'rob006/flarum-lang-polish' => 
    array (
      'pretty_version' => 'v0.4.9',
      'version' => '0.4.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cf3d59dc083586f2d15c4e76965bfabfaa7ed3a2',
    ),
    's9e/regexp-builder' => 
    array (
      'pretty_version' => '1.4.5',
      'version' => '1.4.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '45992e3389e0179672f3a3605d66891a8b64918c',
    ),
    's9e/sweetdom' => 
    array (
      'pretty_version' => '2.0.0',
      'version' => '2.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5fc62bc1f4756650924e5cd1b429afcf34542722',
    ),
    's9e/text-formatter' => 
    array (
      'pretty_version' => '2.9.1',
      'version' => '2.9.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e81057d923f654f1fa6a5a6ed22c872723ff6c33',
    ),
    'sijad/flarum-ext-details' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'sijad/flarum-ext-links' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'sijad/flarum-ext-pages' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'softcreatr/php-mime-detector' => 
    array (
      'pretty_version' => '3.2.0',
      'version' => '3.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '61b5fc1454e248a28a545465fc02d695044ba8c3',
    ),
    'spomky-labs/base64url' => 
    array (
      'pretty_version' => 'v2.0.4',
      'version' => '2.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '7752ce931ec285da4ed1f4c5aa27e45e097be61d',
    ),
    'ssnepenthe/color-utils' => 
    array (
      'pretty_version' => '0.4.2',
      'version' => '0.4.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a68562f81fd603be0c45d102b4e8064c76ddf863',
    ),
    'starsriver/mathplus' => 
    array (
      'pretty_version' => '0.2.1',
      'version' => '0.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '6831b7cccd21604031b1417b83139d5e721d87af',
    ),
    'swiftmailer/swiftmailer' => 
    array (
      'pretty_version' => 'v6.2.7',
      'version' => '6.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '15f7faf8508e04471f666633addacf54c0ab5933',
    ),
    'sycho/flarum-advanced-extension-categories' => 
    array (
      'pretty_version' => 'v0.1.1',
      'version' => '0.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f380c032ce5f3c24c115cb0fdc286cd6ca5447bb',
    ),
    'sycho/flarum-profile-cover' => 
    array (
      'pretty_version' => 'v1.2.4',
      'version' => '1.2.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b0c67047995dc8033276de6efc1af77de6457caa',
    ),
    'symfony/config' => 
    array (
      'pretty_version' => 'v5.2.8',
      'version' => '5.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '8dfa5f8adea9cd5155920069224beb04f11d6b7e',
    ),
    'symfony/console' => 
    array (
      'pretty_version' => 'v5.2.8',
      'version' => '5.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '864568fdc0208b3eba3638b6000b69d2386e6768',
    ),
    'symfony/css-selector' => 
    array (
      'pretty_version' => 'v5.2.7',
      'version' => '5.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '59a684f5ac454f066ecbe6daecce6719aed283fb',
    ),
    'symfony/deprecation-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5f38c8804a9e97d23e0c8d63341088cd8a22d627',
    ),
    'symfony/event-dispatcher' => 
    array (
      'pretty_version' => 'v5.2.4',
      'version' => '5.2.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd08d6ec121a425897951900ab692b612a61d6240',
    ),
    'symfony/event-dispatcher-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '69fee1ad2332a7cbab3aca13591953da9cdb7a11',
    ),
    'symfony/event-dispatcher-implementation' => 
    array (
      'provided' => 
      array (
        0 => '2.0',
      ),
    ),
    'symfony/filesystem' => 
    array (
      'pretty_version' => 'v5.2.7',
      'version' => '5.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '056e92acc21d977c37e6ea8e97374b2a6c8551b0',
    ),
    'symfony/finder' => 
    array (
      'pretty_version' => 'v5.2.8',
      'version' => '5.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'eccb8be70d7a6a2230d05f6ecede40f3fdd9e252',
    ),
    'symfony/http-foundation' => 
    array (
      'pretty_version' => 'v5.2.8',
      'version' => '5.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e8fbbab7c4a71592985019477532629cb2e142dc',
    ),
    'symfony/mime' => 
    array (
      'pretty_version' => 'v5.2.7',
      'version' => '5.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '7af452bf51c46f18da00feb32e1ad36db9426515',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6c942b1ac76c82448322025e084cadc56048b4e',
    ),
    'symfony/polyfill-iconv' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '06fb361659649bcfd6a208a0f1fcaf4e827ad342',
    ),
    'symfony/polyfill-intl-grapheme' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5601e09b69f26c1828b13b6bb87cb07cddba3170',
    ),
    'symfony/polyfill-intl-idn' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2d63434d922daf7da8dd863e7907e67ee3031483',
    ),
    'symfony/polyfill-intl-normalizer' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '43a0283138253ed1d48d352ab6d0bdb3f809f248',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5232de97ee3b75b0360528dae24e73db49566ab1',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cc6e6f9b39fe8075b3dabfbaf5b5f645ae1340c9',
    ),
    'symfony/polyfill-php73' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a678b42e92f86eca04b7fa4c0f6f19d097fb69e2',
    ),
    'symfony/polyfill-php80' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dc3063ba22c2a1fd2f45ed856374d79114998f91',
    ),
    'symfony/process' => 
    array (
      'pretty_version' => 'v5.2.7',
      'version' => '5.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '98cb8eeb72e55d4196dd1e36f1f16e7b3a9a088e',
    ),
    'symfony/service-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f040a30e04b57fbcc9c6cbcf4dbaa96bd318b9bb',
    ),
    'symfony/string' => 
    array (
      'pretty_version' => 'v5.2.8',
      'version' => '5.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '01b35eb64cac8467c3f94cd0ce2d0d376bb7d1db',
    ),
    'symfony/translation' => 
    array (
      'pretty_version' => 'v5.2.8',
      'version' => '5.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '445caa74a5986f1cc9dd91a2975ef68fa7cb2068',
    ),
    'symfony/translation-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '95c812666f3e91db75385749fe219c5e494c7f95',
    ),
    'symfony/translation-implementation' => 
    array (
      'provided' => 
      array (
        0 => '2.3',
      ),
    ),
    'symfony/yaml' => 
    array (
      'pretty_version' => 'v5.2.7',
      'version' => '5.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '76546cbeddd0a9540b4e4e57eddeec3e9bb444a5',
    ),
    'therealsujitk/flarum-ext-gifs' => 
    array (
      'pretty_version' => 'v3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8a6ac4fc1db0cdcbab65223e6d7c28191d4a7ee6',
    ),
    'tijsverkoyen/css-to-inline-styles' => 
    array (
      'pretty_version' => '2.2.3',
      'version' => '2.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b43b05cf43c1b6d849478965062b6ef73e223bb5',
    ),
    'tiu-ram0n/brazilian-portuguese' => 
    array (
      'pretty_version' => '1.1.25',
      'version' => '1.1.25.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c1189149c88f24712981d362bf6fab110f8caf00',
    ),
    'tobscure/json-api' => 
    array (
      'pretty_version' => 'v0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '663d1c1299d4363758e8e440e5849134f218f45c',
    ),
    'tolgaaaltas/flarum-ext-turkish' => 
    array (
      'pretty_version' => '0.16.8',
      'version' => '0.16.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e4a1a0dc4eb848180b5f70be235e750a61d9ac72',
    ),
    'tolgaaaltas/flarum-lang-turkish' => 
    array (
      'pretty_version' => '0.16.8',
      'version' => '0.16.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '75f125eb8e650105e5ca20b08cb6234a6c4bbcc2',
    ),
    'v17development/flarum-blog' => 
    array (
      'pretty_version' => 'v0.3.0',
      'version' => '0.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0c571c8f84bf9cb45306bc985d8f0ce9e4d7eb67',
    ),
    'v17development/flarum-seo' => 
    array (
      'pretty_version' => 'v1.7.2',
      'version' => '1.7.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '877e8bb776d7ddfe8ed5b1d9f0a6e88b9f961c82',
    ),
    'voku/portable-ascii' => 
    array (
      'pretty_version' => '1.5.6',
      'version' => '1.5.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '80953678b19901e5165c56752d087fc11526017c',
    ),
    'web-token/jwt-core' => 
    array (
      'pretty_version' => 'v2.2.10',
      'version' => '2.2.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '53beb6f6c1eec4fa93c1c3e5d9e5701e71fa1678',
    ),
    'web-token/jwt-key-mgmt' => 
    array (
      'pretty_version' => 'v2.2.10',
      'version' => '2.2.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '0b116379515700d237b4e5de86879078ccb09d8a',
    ),
    'web-token/jwt-signature' => 
    array (
      'pretty_version' => 'v2.2.10',
      'version' => '2.2.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '015b59aaf3b6e8fb9f5bd1338845b7464c7d8103',
    ),
    'web-token/jwt-signature-algorithm-ecdsa' => 
    array (
      'pretty_version' => 'v2.2.10',
      'version' => '2.2.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '44cbbb4374c51f1cf48b82ae761efbf24e1a8591',
    ),
    'web-token/jwt-util-ecc' => 
    array (
      'pretty_version' => 'v2.2.10',
      'version' => '2.2.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '915f3fde86f5236c205620d61177b9ef43863deb',
    ),
    'webmozart/assert' => 
    array (
      'pretty_version' => '1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6964c76c7804814a842473e0c8fd15bab0f18e25',
    ),
    'wikimedia/less.php' => 
    array (
      'pretty_version' => 'v3.1.0',
      'version' => '3.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a486d78b9bd16b72f237fc6093aa56d69ce8bd13',
    ),
    'wiseclock/flarum-ext-profile-image-crop' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'wiwatsrt/flarum-ext-best-answer' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'wohali/oauth2-discord-new' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0dcb5059cded358f55ae566de9621652cf8542c6',
    ),
    'wuethrich44/flarum-ext-sso' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'xelson/flarum-ext-chat' => 
    array (
      'pretty_version' => 'v1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '14ac7447e467745144b06d1e3f0c79c7e1a81206',
    ),
    'zendframework/zend-diactoros' => 
    array (
      'replaced' => 
      array (
        0 => '^2.2.1',
      ),
    ),
    'zendframework/zend-escaper' => 
    array (
      'replaced' => 
      array (
        0 => '^2.6.1',
      ),
    ),
    'zendframework/zend-httphandlerrunner' => 
    array (
      'replaced' => 
      array (
        0 => '^1.1.0',
      ),
    ),
    'zendframework/zend-stratigility' => 
    array (
      'replaced' => 
      array (
        0 => '^3.2.0',
      ),
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}

if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}





private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {
foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
