$(document).ready(function () {
  function getCoinbaseWalletProvider() {
    let provider = undefined;

    if (window.ethereum != undefined) {
      if (window.ethereum.providerMap != undefined) {
        // several wallets are installed - find coinbase wallet
        window.ethereum.providers.forEach((prov) => {
          if (prov.isCoinbaseWallet === true) provider = prov;
        });
      } else {
        // single wallet is installed
        if (window.ethereum.isCoinbaseWallet === true) {
          provider = window.ethereum;
        }
      }
    }

    if (provider == undefined) alert("Coinbase wallet is not installed");

    return provider;
  }

  async function checkNetwork(walletProvider) {
    const targetChain = 4; // rinkeby testnet
    // const targetChain = 137; // polygon
    if (walletProvider.getChainId() != targetChain) {
      try {
        await walletProvider.request({
          method: "wallet_switchEthereumChain",
          params: [{ chainId: targetChain.toString(16) }],
        });
      } catch (err) {
        console.log(err);
        alert("Please change to polygon network");
        return false;
      }
    }
    return true;
  }

  $("#login").on("click", async function (event) {
    const walletProvider = getCoinbaseWalletProvider();

    if (walletProvider == undefined || !(await checkNetwork(walletProvider))) {
      return;
    }

    // get message to sign
    let response = await fetch("/login/signature");
    let message = await response.text();

    console.log(message);

    const provider = new ethers.providers.Web3Provider(walletProvider);
    const signer = provider.getSigner();

    const address = await signer.getAddress();
    const signature = await signer.signMessage(message);

    response = await fetch("/login/check_signature", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        address: address,
        signature: signature,
        _token: $('meta[name="csrf-token"]').attr("content"),
      }),
    });
    message = await response.text();

    if (message == "Success") {
      window.location.href = "/";
    } else {
      alert("You need a HidenSeek NFT to login this page.");
    }
  });

  $("#create_game").on("click", async function (event) {
    event.preventDefault();

    const walletProvider = getCoinbaseWalletProvider();

    if (walletProvider == undefined || !(await checkNetwork(walletProvider))) {
      return;
    }

    const provider = new ethers.providers.Web3Provider(walletProvider);
    const signer = provider.getSigner();

    const addrUSDT = "0xc6fDe3FD2Cc2b173aEC24cc3f267cb3Cd78a26B7";

    // The ERC-20 Contract ABI, which is a common contract interface
    // for tokens (this is the Human-Readable ABI format)
    const usdtAbi = [
      // Read-Only Functions
      "function balanceOf(address owner) view returns (uint256)",
      "function decimals() view returns (uint8)",
      "function symbol() view returns (string)",

      // Authenticated Functions
      "function transfer(address to, uint amount) returns (bool)",

      // Events
      "event Transfer(address indexed from, address indexed to, uint amount)",
    ];

    // The Contract object
    const usdt = new ethers.Contract(addrUSDT, usdtAbi, signer);
    const decimals = await usdt.decimals();

    let tx = await usdt.transfer(
      "0x6eee87d99ccf05c0a8297e6b4cf98898e47a0642",
      ethers.utils.parseUnits("1", decimals)
    );

    await tx.wait();

    console.log(tx.hash);

    $("#create_game").submit();
  });
});
